<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SuperuserController extends Controller
{
            public function index()
    {
        $user = UserModel::all();

        $page = (object)[
            'title' => 'Kelola User'
        ];    

        return view('superadmin/user.index', compact('page', 'user'));
    }

public function list(Request $request)
    {    
        $query = UserModel::with('level:id_level,level_nama');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('level_name', function($user) {
                return $user->level->level_nama ?? '-';
            })
            ->addColumn('aksi', function($user) {
                $btn = '<button class="btn btn-info btn-xs" onclick="showPreviewModal('.$user->id_user.')">Preview</button>';
                $btn .= ' <a class="btn btn-warning btn-xs" href="'.url('superadmin/user/' . $user->id_user . '/edit').'">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs" onclick="modalActionDelete('.$user->id_user.')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function input () {
        $user = Level::select('id_level', 'level_nama')->get();

        return view('superadmin.user.input')
            -> with('user', $user);
    }   

    public function store(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_level'  => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'name'     => 'required|string|max:100',
                'password' => 'required|min:6',
            ];

            // Validasi input
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }

            UserModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan',
            ]);
        }
        return redirect('superadmin/user');
    }
    
    public function show($id)
    
    {
    // Cari user berdasarkan ID
    $user = UserModel::findOrFail($id);  // Menggunakan UserModel, bukan User

    // Ambil data yang dibutuhkan
    $data = [
        'username' => $user->username,
        'name' => $user->name,
        'role' => $user->level->level_nama,  // Pastikan ada relasi ke level atau role user
    ];

    // Kembalikan data dalam format JSON
    return response()->json($data);
    
    }

    public function edit($id)
{
    // Ambil data user berdasarkan ID
    $user = UserModel::findOrFail($id);

    // Ambil daftar level untuk dropdown
    $levels = Level::all();

    // Kirim data user dan daftar level ke view
    return view('superadmin.user.edit', compact('user', 'levels'));
}

    public function update(Request $request, $id)
{
    // Validasi data yang masuk
    $rules = [
        'id_level'  => 'required|integer',
        'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',id_user',
        'name'     => 'required|string|max:100',
        'password' => 'nullable|min:6',
    ];

    // Validasi input
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Ambil data user berdasarkan ID
    $user = UserModel::findOrFail($id);

    // Update data user
    $user->update([
        'id_level' => $request->id_level,
        'username' => $request->username,
        'name'     => $request->name,
        'password' => $request->password ? bcrypt($request->password) : $user->password,  // Jika password kosong, gunakan password lama
    ]);

    return redirect()->route('superadmin.user.index')->with('success', 'Data user berhasil diperbarui');
}

public function destroy($id)
{
    // Cari user berdasarkan ID
    $user = UserModel::findOrFail($id);

    // Hapus user
    $user->delete();

    // Kembalikan response JSON jika diakses lewat AJAX
    return response()->json([
        'status' => true,
        'message' => 'User berhasil dihapus.',
    ]);
}



}
