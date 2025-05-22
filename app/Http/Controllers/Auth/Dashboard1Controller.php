<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard1Controller extends Controller
{
    public function index()
    {
        return view('Kajur/dashboard');
    }

    public function showKriteria($id)
    {
        return view('kriteria.show', compact('id'));
    }

    public function showDokumenFinal()
    {
        return view('dokumen.final');
    }
}
