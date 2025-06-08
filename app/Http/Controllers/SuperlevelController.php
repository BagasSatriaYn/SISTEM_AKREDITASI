<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class SuperlevelController extends Controller
{
    public function index()
    {
        $page = (object)[
            'title' => 'Kelola Level'
        ];
        $levels = Level::all();  // Retrieve all levels
        return view('superadmin.level.index', compact('page', 'levels'));
    }

    public function input()
    {
        return view('superadmin.level.input');
    }

      public function list(Request $request)
{
    try {
        $query = Level::query();  // Ambil data level

        return DataTables::of($query)
            ->addIndexColumn()
             ->addColumn('level_kode', function($level) {
                return $level->level_kode;  // Menambahkan kolom level_kode
            })
            ->addColumn('aksi', function($level) {
                // Tombol Edit
                $btn = '<a href="' . route('superadmin.level.edit', $level->id_level) . '" class="btn btn-warning btn-xs">Edit</a>';

                // Tombol Hapus dalam Form
                $btn = '<button class="btn btn-info btn-xs" onclick="showPreviewModal('.$level->id_level.')">Preview</button>';
                $btn .= ' <a class="btn btn-warning btn-xs" href="'.url('superadmin/level/' . $level->id_level . '/edit').'">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs" onclick="modalActionDelete('.$level->id_level.')">Delete</button>';
                $btn .= '</form>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    } catch (\Exception $e) {
        \Log::error('Error fetching levels: ' . $e->getMessage());
        return response()->json(['error' => 'Server error'], 500);
    }
}




    public function store(Request $request)
    {
        $rules = [
            'level_nama' => 'required|string|unique:levels,level_nama|min:3|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        Level::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data level berhasil disimpan',
        ]);
    }

    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('superadmin.level.edit', compact('level'));
    }

    public function show($id)
{
    try {
        // Ambil data level berdasarkan ID
        $level = Level::findOrFail($id);

        // Kembalikan data level dalam format JSON
        return response()->json([
            'level_kode' => $level->level_kode,
            'level_nama' => $level->level_nama,
        ]);
    } catch (\Exception $e) {
        // Tangani error jika tidak dapat menemukan data level
        \Log::error('Error fetching level: ' . $e->getMessage());
        return response()->json(['error' => 'Data level tidak ditemukan'], 500);
    }
}


   public function update(Request $request, $id)
{
    // Validasi data yang masuk
    $rules = [
        'level_kode' => 'required|string|max:255|unique:m_level,level_kode,' . $id . ',id_level',
        'level_nama' => 'required|string|max:100',
    ];

    // Validasi input
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Ambil data level berdasarkan ID
    $level = Level::findOrFail($id);

    // Update data level
    $level->update([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama,
    ]);

    return redirect()->route('superadmin.level.index')->with('success', 'Data level berhasil diperbarui');
}

}

