<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
            
        return response()->json([
            'success' => true,
            'data' => $levels
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_kode' => 'required',
            'level_nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $level = Level::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Level berhasil dibuat',
            'data' => $level
        ]);
    }

    public function show($id)
    {
        $level = Level::find($id);
        
        if (!$level) {
            return response()->json([
                'success' => false,
                'message' => 'Level tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $level
        ]);
    }

    public function update(Request $request, $id)
    {
        $level = Level::find($id);
        
        if (!$level) {
            return response()->json([
                'success' => false,
                'message' => 'Level tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'level_kode' => 'required',
            'level_nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $level->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Level berhasil diperbarui',
            'data' => $level
        ]);
    }

    public function destroy($id)
    {
        $level = Level::find($id);
        
        if (!$level) {
            return response()->json([
                'success' => false,
                'message' => 'Level tidak ditemukan'
            ], 404);
        }

        // Check if level is being used by users
        if ($level->users()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Level tidak dapat dihapus karena sedang digunakan'
            ], 400);
        }

        $level->delete();

        return response()->json([
            'success' => true,
            'message' => 'Level berhasil dihapus'
        ]);
    }
}
