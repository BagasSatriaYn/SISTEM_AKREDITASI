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
    // Debug untuk melihat request yang masuk
    Log::info('Request data:', $request->all());
    
    $details = DetailKriteria::with('kriteria:id_kriteria,nama')
        ->select('id_detail_kriteria', 'id_kriteria', 'status');

    $details->where('id_kriteria', 9);

    // Filter data berdasarkan id_detail_kriteria
    if ($request->has('id_detail_kriteria') && $request->id_detail_kriteria) {
        $details->where('id_detail_kriteria', $request->id_detail_kriteria);
    }
    
    // Debug untuk melihat query yang dijalankan
    Log::info('Query SQL: ' . $details->toSql());
    Log::info('Query Bindings: ', $details->getBindings());
    
    // Debug jumlah data yang ditemukan
    $count = $details->count();
    Log::info('Data count: ' . $count);
    
    return DataTables::of($details)
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
}
        
public function checkData()
{
    $data = DetailKriteria::with('kriteria')
        ->where('id_kriteria', 9)
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
        // Fungsi untuk upload file dan return path
     // Fungsi upload file ke storage/public/kriteria dan return URL-nya
$uploadImageAsHTML = function ($file, $prefix = 'file') {
    if ($file) {
        $filename = $prefix.'_'.time().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('public/kriteria', $filename);
        $url = Storage::url($path); // hasil: /storage/kriteria/nama_file.jpg
        return '<p><img src="' . $url . '" style="max-width: 100%;"></p>';
    }
    return '';
};
$kriteria = Kriteria::findOrFail($request->id_kriteria);

// Simpan data Penetapan
$penetapan = $kriteria->penetapan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_penetapan . $uploadImageAsHTML($request->file('penetapan_file'), 'penetapan'),
    'pendukung' => $uploadImageAsHTML($request->file('penetapan_file'), 'penetapan'),
]);

$pelaksanaan = $kriteria->pelaksanaan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_pelaksanaan . $uploadImageAsHTML($request->file('pelaksanaan_file'), 'pelaksanaan'),
    'pendukung' => $uploadImageAsHTML($request->file('pelaksanaan_file'), 'pelaksanaan'),
]);

$evaluasi = $kriteria->evaluasi()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_evaluasi . $uploadImageAsHTML($request->file('evaluasi_file'), 'evaluasi'),
    'pendukung' => $uploadImageAsHTML($request->file('evaluasi_file'), 'evaluasi'),
]);

$pengendalian = $kriteria->pengendalian()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_pengendalian . $uploadImageAsHTML($request->file('pengendalian_file'), 'pengendalian'),
    'pendukung' => $uploadImageAsHTML($request->file('pengendalian_file'), 'pengendalian'),
]);

$peningkatan = $kriteria->peningkatan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_peningkatan . $uploadImageAsHTML($request->file('peningkatan_file'), 'peningkatan'),
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
            'id_penetapan' => $penetapan->id_penetapan,
            'id_pelaksanaan' => $pelaksanaan->id_pelaksanaan,
            'id_evaluasi' => $evaluasi->id_evaluasi,
            'id_pengendalian' => $pengendalian->id_pengendalian,
            'id_peningkatan' => $peningkatan->id_peningkatan,
            'id_kriteria' => $kriteria->id_kriteria,
            'id_komentar' => null, // atau bisa diisi sesuai kebutuhan
            'id_finalisasi' => $idFinalisasi,
            'status' => $request->status
        ]);

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
            'error' => $e->getTraceAsString() // Hanya untuk development
        ], 500);
    }
}

    public function show($id)
    {
    // Menghapus prefix 'A' dan mendapatkan angka kriteria
    $kriteria_id = substr($id, 1);  // Mengambil angka setelah huruf 'A', misalnya 'A1' menjadi 1

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
        if ($detail->penetapan && $detail->penetapan->penetapan) {
            $detail->penetapan->penetapan = str_replace(
                '../storage/',
                rtrim(url('storage'), '/') . '/', // Gunakan url() helper bukan asset()
                $detail->penetapan->penetapan
            );
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

public function preview($id)
{
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
        return \PDF::loadView('kriteria9.export', ['details' => $detail])
                   ->stream('dokumen_ppepp.pdf');
    } catch (\Exception $e) {
        Log::error("❌ Gagal generate PDF: " . $e->getMessage());
        abort(500, 'PDF error');
    }
}


    public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {
        $detail = DetailKriteria::findOrFail($id);

        // Validasi
        $validator = Validator::make($request->all(), [
            'desk_penetapan' => 'required',
            'desk_pelaksanaan' => 'required',
            'desk_evaluasi' => 'required',
            'desk_pengendalian' => 'required',
            'desk_peningkatan' => 'required',
            'status' => 'required|in:save,submitted'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update tiap bagian PPEPP
        $detail->penetapan->update([
            'deskripsi' => $request->desk_penetapan,
        ]);
        $detail->pelaksanaan->update([
            'deskripsi' => $request->desk_pelaksanaan,
        ]);
        $detail->evaluasi->update([
            'deskripsi' => $request->desk_evaluasi,
        ]);
        $detail->pengendalian->update([
            'deskripsi' => $request->desk_pengendalian,
        ]);
        $detail->peningkatan->update([
            'deskripsi' => $request->desk_peningkatan,
        ]);

        // Update status
        $detail->status = $request->status;
        $detail->save();

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui.'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Gagal update data: ' . $e->getMessage()
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
            // Cek komentar terakhir untuk menentukan siapa yang menolak
            if ($detail->komentar) {
                // Misalnya kamu punya kolom `role` atau `tipe` di tabel komentar
                // Kalau belum ada, kita asumsikan dari alur status sebelumnya
                // Kalau sebelumnya acc1 → artinya direvisi oleh Direktur
                $validator = 'Kajur'; // atau 'Kajur' jika dari tahap 1
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

        // 1. Hapus detail_kriteria dulu (agar FK ke penetapan, dll bebas)
        $detail->delete();

        // 2. Baru hapus anak-anaknya (tidak ada FK lagi ke mereka)
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
}