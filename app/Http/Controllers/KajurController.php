<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KajurController extends Controller
{
    public function dashboard()
    {
    $page = (object)[
        'title' => 'Dashboard Kajur',
    ];
    return view('Kajur.dashboard', compact('page'));
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
