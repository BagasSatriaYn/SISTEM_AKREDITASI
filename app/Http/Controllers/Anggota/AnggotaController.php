<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kriteria;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user(); 
       

        return view('anggota.dashboard', compact('user', 'kriteria'));
    }
}
