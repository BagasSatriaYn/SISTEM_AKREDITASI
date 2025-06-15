<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log; 
    use App\Models\Evaluasi;
    use App\Models\Kriteria;
    use App\Models\Penetapan;
    use App\Models\Pelaksanaan;
    use App\Models\Peningkatan;
    use App\Models\Pengendalian;
    use App\Models\DetailKriteria;
    use App\Models\Finalisasi;
    use Illuminate\Support\Facades\DB;  
    use Illuminate\Support\Facades\Storage;
    use Yajra\DataTables\Facades\DataTables;
    use Illuminate\Support\Facades\Validator;
    use Barryvdh\DomPDF\Facade\Pdf;
    use Illuminate\Support\Str;
    use App\Http\Controllers\NotificationController;
    

class KriteriaSembilanController extends Controller
{
     public function index()
{
    $kriterias = Kriteria::all(); // ambil semua kriteria

    $page = (object)[   
        'title' => 'Daftar Kriteria 9'
    ];    

    return view('kriteria9.index', compact('page', 'kriterias'));
}

    public function input()
    {
        $page = (object)[
            'title' => 'Input Kriteria'
        ];
        $kriteria = Kriteria::all();

    return view('kriteria9.input', compact('page', 'kriteria'));
    }

      public function list(Request $request)
{
    Log::info('Request data:', $request->all());
    
    $details = DetailKriteria::with('kriteria:id_kriteria,nama')
        ->select('id_detail_kriteria', 'id_kriteria', 'status', 'validated_by'); // ✅ TAMBAHKAN validated_by

    $details->where('id_kriteria', 9);

    if ($request->has('id_detail_kriteria') && $request->id_detail_kriteria) {
        $details->where('id_detail_kriteria', $request->id_detail_kriteria);
    }

    Log::info('Query SQL: ' . $details->toSql());
    Log::info('Query Bindings: ', $details->getBindings());
    Log::info('Data count: ' . $details->count());

    return DataTables::of($details)
        ->addIndexColumn()
        ->addColumn('kriteria.nama', function ($row) {
            return $row->kriteria->nama ?? '-';
        })
        ->addColumn('validated_by', function ($row) {
            return $row->validated_by ?? '-';
        })
        ->addColumn('aksi', function ($row) {
            $id = $row->id_detail_kriteria;
            $status = $row->status;

            $previewBtn = "<button class='btn btn-info btn-xs' onclick='showPreviewModal($id)'>Preview</button>";
            $editBtn = ($status === 'submit')
                ? "<a class='btn btn-secondary btn-xs disabled' href='#'>Edit</a>"
                : "<a class='btn btn-warning btn-xs' href='kriteria9/{$id}/edit'>Edit</a>";
            $deleteBtn = "<button class='btn btn-danger btn-xs' onclick='modalActionDelete($id)'>Delete</button>";

            return "$previewBtn $editBtn $deleteBtn";
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

        
public function checkData()
{
    $data = DetailKriteria::with('kriteria')
        ->where('id_kriteria', 1)
        ->get();
    
    dd($data->toArray()); // Dump and die untuk melihat data
}
   public function create()
{
    $kriteria = Kriteria::select('id_kriteria', 'nama')->get();

    $breadcrumb = (object) [
        'title' => __('LUARAN DAN CAPAIAN TRIDARMA'),
        'list' => __('LUARAN DAN CAPAIAN TRIDARMA')
    ];

    $page = (object) [
        'title' => __('LUARAN DAN CAPAIAN TRIDARMA'),
    ];

    $activeMenu = 'kriteria';
    $activeSubmenu = 'kriteria9';

    return view('kriteria9.input', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'activeMenu' => $activeMenu,
        'activeSubmenu' => $activeSubmenu,
        'kriteria' => $kriteria, // langsung dikirim dalam array
    ]);
}

public function store(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'id_kriteria' => 'required|exists:t_kriteria,id_kriteria',
        'desk_penetapan' => 'required',
        'desk_pelaksanaan' => 'required',
        'desk_evaluasi' => 'required',
        'desk_pengendalian' => 'required',
        'desk_peningkatan' => 'required',
        'penetapan_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pelaksanaan_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'evaluasi_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pengendalian_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'peningkatan_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:save,submitted'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    DB::beginTransaction();
    try {
        // Fungsi upload file
        $uploadImageAsHTML = function ($file, $prefix = 'file') {
    if ($file) {
        $filename = $prefix.'_'.time().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('public/kriteria', $filename);
        
        $fullPath = storage_path('app/' . $path);
        if (file_exists($fullPath)) {
            $content = file_get_contents($fullPath);
            $type = pathinfo($fullPath, PATHINFO_EXTENSION);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($content);
            return '<p><img src="' . $base64 . '" style="max-width:100%;"></p>';
        }
    }
    return '';
};


        $kriteria = Kriteria::findOrFail($request->id_kriteria);

        // Simpan data PPEPP
        $penetapan = $kriteria->penetapan()->create([
            'id_kriteria' => $kriteria->id_kriteria,
            'deskripsi' => $request->desk_penetapan,
            'pendukung' => $uploadImageAsHTML($request->file('penetapan_file'), 'penetapan'),
        ]);

        $pelaksanaan = $kriteria->pelaksanaan()->create([
            'id_kriteria' => $kriteria->id_kriteria,
            'deskripsi' => $request->desk_pelaksanaan,
            'pendukung' => $uploadImageAsHTML($request->file('pelaksanaan_file'), 'pelaksanaan'),
        ]);

        $evaluasi = $kriteria->evaluasi()->create([
            'id_kriteria' => $kriteria->id_kriteria,
            'deskripsi' => $request->desk_evaluasi,
            'pendukung' => $uploadImageAsHTML($request->file('evaluasi_file'), 'evaluasi'),
        ]);

        $pengendalian = $kriteria->pengendalian()->create([
            'id_kriteria' => $kriteria->id_kriteria,
            'deskripsi' => $request->desk_pengendalian,
            'pendukung' => $uploadImageAsHTML($request->file('pengendalian_file'), 'pengendalian'),
        ]);

        $peningkatan = $kriteria->peningkatan()->create([
            'id_kriteria' => $kriteria->id_kriteria,
            'deskripsi' => $request->desk_peningkatan,
            'pendukung' => $uploadImageAsHTML($request->file('peningkatan_file'), 'peningkatan'),
        ]);

// Cari semua id_finalisasi yang sudah digunakan untuk kriteria ini
$usedFinalisasiIds = DetailKriteria::where('id_kriteria', $kriteria->id_kriteria)
    ->pluck('id_finalisasi')
    ->toArray();

// Cari finalisasi yang belum dipakai oleh kriteria ini
$availableFinalisasi = Finalisasi::whereNotIn('id_finalisasi', $usedFinalisasiIds)->first();

if ($availableFinalisasi) {
    $idFinalisasi = $availableFinalisasi->id_finalisasi;
} else {
    // Jika tidak ada finalisasi yang belum dipakai kriteria ini, buat yang baru
    $newFinalisasi = Finalisasi::create([
        'name' => 'Dokumen Final - ' . now()->format('Ymd-His')
    ]);
    $idFinalisasi = $newFinalisasi->id_finalisasi;
}

       $detailKriteria = DetailKriteria::create([
    'id_user' => auth()->user()->id_user, // ✅ ini penting!
    'id_penetapan' => $penetapan->id_penetapan,
    'id_pelaksanaan' => $pelaksanaan->id_pelaksanaan,
    'id_evaluasi' => $evaluasi->id_evaluasi,
    'id_pengendalian' => $pengendalian->id_pengendalian,
    'id_peningkatan' => $peningkatan->id_peningkatan,
    'id_kriteria' => $kriteria->id_kriteria,
    'id_komentar' => null,
    'id_finalisasi' => $idFinalisasi,
    'status' => $request->status
    
]);
    NotificationController::storeNotification(
    $request->status,
    $kriteria->id_kriteria,
    auth()->user()->id_user
);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Data PPEPP berhasil disimpan',
            'data' => $kriteria->load(['penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'])
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            'error' => $e->getTraceAsString()
        ], 500);
    }
}

    public function show($id)
    {
    // Menghapus prefix 'A' dan mendapatkan angka kriteria
    $kriteria_id = substr($id, 9);  // Mengambil angka setelah huruf 'A', misalnya 'A1' menjadi 1

    $kriteria = Kriteria::find($kriteria_id);
    
    if (!$kriteria) {
        return response()->json([
            'success' => false,
            'message' => 'Kriteria tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $kriteria
    ]);
}
    public function edit($id)
    {
        $detail = DetailKriteria::with([
            'penetapan',
            'pelaksanaan',
            'evaluasi',
            'pengendalian',
            'peningkatan'
        ])->findOrFail($id);

        // Konversi path relatif ke absolut
        if ($detail->penetapan && $detail->penetapan->pendukung) {
    $detail->penetapan->pendukung = asset('storage/' . $detail->penetapan->pendukung);
}


        $kriteria = Kriteria::select('id_kriteria', 'nama')->get();

        $breadcrumb = (object) [
            'title' => 'Edit Kriteria Sembilan',
            'list' => ['Kriteria', 'Kriteria9', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kriteria 9 - LUARAN DAN CAPAIAN TRIDARMA',
        ];

        $activeMenu = 'kriteria';
        $activeSubmenu = 'kriteria9';

        return view('kriteria9.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubmenu' => $activeSubmenu,
            'detail' => $detail,
            'kriteria' => $kriteria
        ]);
    }

    

public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/pendukung', $filename);

            return response()->json([
                'status' => true,
                'url' => asset(Storage::url('pendukung/' . $filename)),
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'File tidak ditemukan.',
        ]);
    }

public function preview($id)
{
    set_time_limit(300);
    ini_set('pcre.backtrack_limit', '5000000');
    Log::info("🔍 Masuk preview() dengan ID: $id");

    // Ambil langsung detail berdasarkan ID (angka)
    $detail = DetailKriteria::with([
        'kriteria',
        'penetapan',
        'pelaksanaan',
        'evaluasi',
        'pengendalian',
        'peningkatan'
    ])->findOrFail($id);

    
    try {
        return Pdf::loadView('kriteria9.export', ['details' => $detail])
          ->stream('dokumen_ppepp.pdf');

    } catch (\Exception $e) {
        Log::error("❌ Gagal generate PDF: " . $e->getMessage());
        abort(500, 'PDF error');
    }
}



  public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'desk_penetapan' => 'required',
        'desk_pelaksanaan' => 'required',
        'desk_evaluasi' => 'required',
        'desk_pengendalian' => 'required',
        'desk_peningkatan' => 'required',
        'penetapan_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pelaksanaan_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'evaluasi_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pengendalian_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'peningkatan_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:save,submitted'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    DB::beginTransaction();
    try {
        $detail = DetailKriteria::with(['penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'])->findOrFail($id);

        // Fungsi upload gambar
        $upload = function ($file, $lama = null, $prefix = 'file') {
    if ($file) {
        if ($lama && Storage::exists('public/' . $lama)) {
            Storage::delete('public/' . $lama);
        }

        $filename = $prefix.'_'.time().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('public/kriteria', $filename);

        $fullPath = storage_path('app/' . $path);
        if (file_exists($fullPath)) {
            $content = file_get_contents($fullPath);
            $type = pathinfo($fullPath, PATHINFO_EXTENSION);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($content);
            return '<p><img src="' . $base64 . '" style="max-width:100%;"></p>';
        }
    }

    return $lama; // base64 lama tetap dipakai
};

        // Update setiap bagian
        $detail->penetapan->update([
        'deskripsi' => $request->desk_penetapan,
        'pendukung' => $upload($request->file('penetapan_file'), $detail->penetapan->pendukung, 'penetapan'),
    ]);

            $detail->pelaksanaan->update([
        'deskripsi' => $request->desk_pelaksanaan,
        'pendukung' => $upload($request->file('pelaksanaan_file'), $detail->pelaksanaan->pendukung, 'pelaksanaan'),
    ]);


        $detail->evaluasi->update([
            'deskripsi' => $request->desk_evaluasi,
            'pendukung' => $upload($request->file('evaluasi_file'), $detail->evaluasi->pendukung)
        ]);

        $detail->pengendalian->update([
            'deskripsi' => $request->desk_pengendalian,
            'pendukung' => $upload($request->file('pengendalian_file'), $detail->pengendalian->pendukung)
        ]);

        $detail->peningkatan->update([
            'deskripsi' => $request->desk_peningkatan,
            'pendukung' => $upload($request->file('peningkatan_file'), $detail->peningkatan->pendukung)
        ]);

        $detail->status = $request->status;
        $detail->save();

        NotificationController::storeNotification(
            $request->status,
            $id, // ini adalah id_detail_kriteria
            auth()->user()->id_user
        );  

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui.',
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Gagal update: ' . $e->getMessage()
        ], 500);
    }
}



    public function getPreviewData($id)
    {
        $detail = DetailKriteria::with(['kriteria', 'komentar'])->findOrFail($id);

        $validator = '-';
        $catatan = '-';

        if ($detail->status === 'acc1') {
            $validator = 'Kajur';
        } elseif ($detail->status === 'acc2') {
            $validator = 'Direktur';    
        } elseif ($detail->status === 'revisi') {
            if ($detail->komentar) {
                $validator = 'Kajur';
            }
        }

        if ($detail->komentar) {
            $catatan = $detail->komentar->komen;
        }

        return response()->json([
            'validator' => $validator,
            'status' => strtoupper($detail->status),
            'catatan' => $catatan,
            'pdf_url' => route('kriteria9.preview', $id)
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $detail = DetailKriteria::with([
                'penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'
            ])->findOrFail($id);

            $detail->delete();

            if ($detail->penetapan) $detail->penetapan->delete();
            if ($detail->pelaksanaan) $detail->pelaksanaan->delete();
            if ($detail->evaluasi) $detail->evaluasi->delete();
            if ($detail->pengendalian) $detail->pengendalian->delete();
            if ($detail->peningkatan) $detail->peningkatan->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function dashboard()
    {
        $dataKriteria = DetailKriteria::with('kriteria')->get();
        return view('anggota.dashboard', compact('dataKriteria'));
    }
}
