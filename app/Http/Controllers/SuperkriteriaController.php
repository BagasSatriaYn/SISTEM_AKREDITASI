<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SuperkriteriaController extends Controller
{
    public function index()
    {
        $page = (object)[
            'title' => 'Kelola Kriteria'
        ];
        return view('superadmin.kriteria.index', compact('page'));
    }

    public function list(Request $request)
    {
        $query = Kriteria::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kriteria) {
                return '
                    <button class="btn btn-info btn-sm" onclick="showPreviewModal(' . $kriteria->id_kriteria . ')">Preview</button>
                    <a class="btn btn-warning btn-sm" href="' . route('superadmin.kriteria.edit', $kriteria->id_kriteria) . '">Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="modalActionDelete(' . $kriteria->id_kriteria . ')">Hapus</button>
                ';
            })

            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function show($id)
    {
    $kriteria = Kriteria::findOrFail($id);

    return response()->json([
        'id_kriteria' => $kriteria->id_kriteria,
        'nama' => $kriteria->nama,
    ]);
    }


    public function input()
    {
        return view('superadmin.kriteria.input');
    }

    public function store(Request $request)
    {
        $rules = ['nama' => 'required|string|max:50|unique:t_kriteria,nama'];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Kriteria::create(['nama' => $request->nama]);

        return redirect()->route('superadmin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('superadmin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $rules = ['nama' => 'required|string|max:50|unique:t_kriteria,nama,' . $id . ',id_kriteria'];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update(['nama' => $request->nama]);

        return redirect()->route('superadmin.kriteria.index')->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kriteria berhasil dihapus.'
        ]);
    }
}
