<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{

public function dashboard()
{
    $userId = auth()->user()->id;

    // Ambil kriteria sesuai user
    $kriteria = Kriteria::where('id_user', $userId)->first();

    return view('anggota.dashboard', compact('kriteria'));
}
}