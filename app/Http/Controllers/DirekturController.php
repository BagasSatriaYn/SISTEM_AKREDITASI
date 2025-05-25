<?php

namespace App\Http\Controllers;
    
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DirekturController extends Controller
{
    public function dashboard()
    {
    $page = (object)[
        'title' => 'Dashboard Direktur/KJM',
    ];
    return view('Direktur.dashboard', compact('page'));
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
