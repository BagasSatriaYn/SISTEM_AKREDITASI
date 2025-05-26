<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenFinalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dokumen Final',
            'menu' => 'Dokumen Final',
            'data' => [
                'profit_programs' => 'Profit Programs',
                'disclaimer' => [
                    'refresh' => [
                        'Written 1', 'Written 2', 'Written 3', 'Written 4',
                        'Written 5', 'Written 6', 'Written 7', 'Written 8', 'Written 9'
                    ]
                ]
            ],
            'laporan' => [
                'judul' => 'PENERAPAN PYTHON DALAM SAMPLING DAN DISTRIBUSI SAMPLING',
                'deskripsi' => 'Disusun untuk memenuhi nilai tugas',
                'mata_kuliah' => 'Mata Kuliah : Statistika',
                'penulis' => [
                    'nama' => 'Aqueena Reglia Hapsari',
                    'nim' => '2341760096',
                    'kelas' => 'SIB 2B',
                    'tanggal' => '03'
                ],
                'institusi' => 'PROGRAM STUDI D-IV SISTEM INFORMASI BISNIS POLITEKNIK NEGERI MALANG TAHUN AJARAN 2024/2025'
            ]
        ];

        return view('DokumenFinal.index', $data);
    }
}