<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;  
use App\Models\Penetapan;
use App\Models\Pelaksanaan;
use App\Models\Evaluasi;
use App\Models\Pengendalian;
use App\Models\Peningkatan;

class KriteriaController extends Controller
{
     public function index()
    {
        $kriteria = Kriteria::all();
        
        $page = (object)[
        'title' => 'Daftar Kriteria 1'];

           return view('kriteria1.index', compact('page'));
    }

    public function input()
    {
        $page = (object)[
            'title' => 'Input Kriteria'
        ];
        $kriteria = Kriteria::all();

    return view('kriteria1.input', compact('page', 'kriteria'));
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
        'status' => 'required|in:save,submit'
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
$kriteria->penetapan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_penetapan,
    'pendukung' => $request->hasFile('penetapan_file') ? 
                  $uploadFile($request->file('penetapan_file'), 'penetapan') : null,
]);

// Simpan data Pelaksanaan
$kriteria->pelaksanaan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_pelaksanaan,
    'pendukung' => $request->hasFile('pelaksanaan_file') ? 
                  $uploadFile($request->file('pelaksanaan_file'), 'pelaksanaan') : null,
]);

// Simpan data Evaluasi
$kriteria->evaluasi()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_evaluasi,
    'pendukung' => $request->hasFile('evaluasi_file') ? 
                  $uploadFile($request->file('evaluasi_file'), 'evaluasi') : null,
]);

// Simpan data Pengendalian
$kriteria->pengendalian()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_pengendalian,
    'pendukung' => $request->hasFile('pengendalian_file') ? 
                  $uploadFile($request->file('pengendalian_file'), 'pengendalian') : null,
]);

// Simpan data Peningkatan
$kriteria->peningkatan()->create([
    'id_kriteria' => $kriteria->id_kriteria,
    'deskripsi' => $request->desk_peningkatan,
    'pendukung' => $request->hasFile('peningkatan_file') ? 
                  $uploadFile($request->file('peningkatan_file'), 'peningkatan') : null,
]);


        DB::commit();

        return response()->json([
            'success' => true,
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


    public function update(Request $request, $id)
{
    $kriteria_id = substr($id, 1);  // Ambil angka setelah huruf 'A'

    $kriteria = Kriteria::find($kriteria_id);

    if (!$kriteria) {
        return response()->json([
            'success' => false,
            'message' => 'Kriteria tidak ditemukan'
        ], 404);
    }

    $validator = Validator::make($request->all(), [
        'nama_kriteria' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $kriteria->update($request->all());

    return response()->json([
        'success' => true,
        'message' => 'Kriteria berhasil diperbarui',
        'data' => $kriteria
    ]);
}


    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        
        if (!$kriteria) {
            return response()->json([
                'success' => false,
                'message' => 'Kriteria tidak ditemukan'
            ], 404);
        }

        // Check if kriteria is being used
        if ($kriteria->detailKriteria()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Kriteria tidak dapat dihapus karena sedang digunakan'
            ], 400);
        }

        $kriteria->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kriteria berhasil dihapus'
        ]);
    }   
}
