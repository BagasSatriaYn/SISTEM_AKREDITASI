<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function show()
    {
        $data = [
            'title' => 'Laporan Praktikum',
            'laporan' => [
                'judul_utama' => 'LAPORAN PRAKTIKUM JOBSHEET 5',
                'judul_khusus' => 'PENERAPAN PYTHON DALAM SAMPLING DAN DISTRIBUSI SAMPLING',
                'deskripsi' => 'Dissuun untuk memenuhi nilai tugas',
                'mata_kuliah' => 'Mua Kuliah : Statistika',
                'institusi' => 'PROGRAM STUDI D-IV SISTEM INFORMASI BISNIS POLITEKNIK NEGERI MALANG TAHUN AJARAN 2024/2025'
            ]
        ];

        return view('dokumen.final', $data);
    }
}