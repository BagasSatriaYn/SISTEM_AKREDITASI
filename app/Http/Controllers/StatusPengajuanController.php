<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKriteria;

class StatusPengajuanController extends Controller
{
    public function index()
    {
        // Ambil data dengan status yang diinginkan
        $detailKriteria = DetailKriteria::whereIn('status', ['acc1', 'acc2', 'submitted'])
            ->with('kriteria') // Eager load relasi kriteria
            ->orderBy('id_detail_kriteria', 'desc')
            ->paginate(10); // Paginasi 10 data per halaman

        return view('status-pengajuan', compact('detailKriteria'));
    }
}