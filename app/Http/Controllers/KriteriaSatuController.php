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
    use Illuminate\Support\Facades\DB;  
    use Illuminate\Support\Facades\Storage;
    use Yajra\DataTables\Facades\DataTables;
    use Illuminate\Support\Facades\Validator;
    use Barryvdh\DomPDF\Facade\Pdf;

class KriteriaSatuController extends Controller
{
     public function index()
{
    $kriterias = Kriteria::all(); // ambil semua kriteria

    $page = (object)[
        'title' => 'Daftar Kriteria 1'
    ];    

    return view('kriteria1.index', compact('page', 'kriterias'));
}

    public function input()
    {
        $page = (object)[
            'title' => 'Input Kriteria'
        ];
        $kriteria = Kriteria::all();

    return view('kriteria1.input', compact('page', 'kriteria'));
    }

       public function list(Request $request)
{
    // Debug untuk melihat request yang masuk
    Log::info('Request data:', $request->all());
    
    $details = DetailKriteria::with('kriteria:id_kriteria,nama')
        ->select('id_detail_kriteria', 'id_kriteria', 'status');

    $details->where('id_kriteria', 1);

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
        ->where('id_kriteria', 1)
        ->get();
    
    dd($data->toArray()); // Dump and die untuk melihat data
}
   public function create()
{
    $kriteria = Kriteria::select('id_kriteria', 'nama')->get();

    $breadcrumb = (object) [
        'title' => __('messages.krit1_title'),
        'list' => __('messages.krit1_list')
    ];

    $page = (object) [
        'title' => __('messages.krit1_page'),
    ];

    $activeMenu = 'kriteria';
    $activeSubmenu = 'kriteria1';

    return view('kriteria1.input', [
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
        $uploadFile = function ($file, $prefix = 'file') {
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $prefix.'_'.time().'.'.$extension;
                $path = $file->storeAs('public/kriteria', $filename);
                return Storage::url($path);
            }
            return null;
        };

        // Dapatkan kriteria
        $kriteria = Kriteria::findOrFail($request->id_kriteria);

        // Simpan data Penetapan
$penetapan = $kriteria->penetapan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_penetapan,
    'pendukung' => $request->hasFile('penetapan_file') ? 
                  $uploadFile($request->file('penetapan_file'), 'penetapan') : null,
]);

// Simpan data Pelaksanaan
$pelaksanaan = $kriteria->pelaksanaan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_pelaksanaan,
    'pendukung' => $request->hasFile('pelaksanaan_file') ? 
                  $uploadFile($request->file('pelaksanaan_file'), 'pelaksanaan') : null,
]);

// Simpan data Evaluasi
$evaluasi = $kriteria->evaluasi()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_evaluasi,
    'pendukung' => $request->hasFile('evaluasi_file') ? 
                  $uploadFile($request->file('evaluasi_file'), 'evaluasi') : null,
]);

// Simpan data Pengendalian
$pengendalian = $kriteria->pengendalian()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_pengendalian,
    'pendukung' => $request->hasFile('pengendalian_file') ? 
                  $uploadFile($request->file('pengendalian_file'), 'pengendalian') : null,
]);

// Simpan data Peningkatan
$peningkatan = $kriteria->peningkatan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_peningkatan,
    'pendukung' => $request->hasFile('peningkatan_file') ? 
                  $uploadFile($request->file('peningkatan_file'), 'peningkatan') : null,
]);

        $detailKriteria = DetailKriteria::create([
            'id_penetapan' => $penetapan->id_penetapan,
            'id_pelaksanaan' => $pelaksanaan->id_pelaksanaan,
            'id_evaluasi' => $evaluasi->id_evaluasi,
            'id_pengendalian' => $pengendalian->id_pengendalian,
            'id_peningkatan' => $peningkatan->id_peningkatan,
            'id_kriteria' => $kriteria->id_kriteria,
            'id_komentar' => null, // atau bisa diisi sesuai kebutuhan
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
            'title' => 'Edit Kriteria Satu',
            'list' => ['Kriteria', 'Kriteria1', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kriteria 1 - Statuta Polinema',
        ];

        $activeMenu = 'kriteria';
        $activeSubmenu = 'kriteria1';

        return view('kriteria1.edit', [
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
        return \PDF::loadView('kriteria1.export', ['details' => $detail])
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