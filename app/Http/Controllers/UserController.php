<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
     public function index()
{
    $user = auth()->user();
    $levelKode = $user->level->level_kode;

    if (preg_match('/^A[1-9]$/', $levelKode)) {
        return view('admin.index', [
            'kriteria_id' => $levelKode,
        ]);
    }

    switch ($levelKode) {
        case 'SUPER':
            return view('superadmin.dashboard');
        case 'KJR':
            return view('kajur.dashboard');
        case 'SPI':
            return view('spi.dashboard');
        case 'DKT':
            return view('direktur.dashboard');
        default:
            abort(403);
    }
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_level' => 'required|exists:m_level,id_level',
            'username' => 'required|unique:m_user,username',
            'name' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'id_level' => $request->id_level,
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat',
            'data' => $user
        ]);
    }

    public function create()
    {
        $users = User::select('id', 'name')->get(); 
        return view('namaview', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('level')->find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_level' => 'required|exists:m_level,id_level',
            'username' => 'required|unique:m_user,username,'.$id.',id_user',
            'name' => 'required',
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userData = [
            'id_level' => $request->id_level,
            'username' => $request->username,
            'name' => $request->name,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diperbarui',
            'data' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }
}
