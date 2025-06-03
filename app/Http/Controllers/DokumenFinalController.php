<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Niklasravnsborg\LaravelPdf\Facades\Pdf;

class DokumenFinalController extends Controller
{
    public function index()
    {
        // Tampilkan daftar batch finalisasi yang sudah ada
        $finalisasiList = DB::table('t_detail_kriteria')
            ->select('id_finalisasi')
            ->distinct()
            ->get();

        return view('DokumenFinal.index', compact('finalisasiList'));
    }

    public function show($idFinalisasi)
    {
        $totalKriteria = 9;

        // Cek jumlah kriteria dengan status acc2 pada id_finalisasi tertentu
        $acc2Count = DB::table('t_detail_kriteria')
            ->where('id_finalisasi', $idFinalisasi)
            ->where('status', 'acc2')
            ->count();

        if ($acc2Count < $totalKriteria) {
            return redirect()->back()->with('error', 'Belum semua kriteria disetujui direktur.');
        }

        // Ambil data dokumen kriteria untuk finalisasi
        $dokumenList = DB::table('t_detail_kriteria')
            ->where('id_finalisasi', $idFinalisasi)
            ->get();

        return view('DokumenFinal.show', compact('dokumenList', 'idFinalisasi'));
    }

    // Contoh fungsi untuk menggabungkan PDF (placeholder)
   public function mergePdf($idFinalisasi)
{
    // Ambil semua path file PDF berdasarkan id_finalisasi, contoh:
    $dokumenList = \DB::table('t_detail_kriteria')
        ->where('id_finalisasi', $idFinalisasi)
        ->where('status', 'acc2')
        ->get();

    $pdfFiles = [];
    foreach ($dokumenList as $dokumen) {
        // Asumsikan kamu punya kolom file_path untuk path PDF
        $pdfFiles[] = storage_path('app/public/' . $dokumen->file_path);
    }

    $pdfMerger = new \iio\libmergepdf\Merger();

    foreach ($pdfFiles as $file) {
        $pdfMerger->addFile($file);
    }

    $mergedPdf = $pdfMerger->merge();

    // Simpan hasil gabungan ke file baru
    $outputPath = storage_path('app/public/finalisasi_'.$idFinalisasi.'.pdf');
    file_put_contents($outputPath, $mergedPdf);

    // Berikan response download atau redirect
    return response()->download($outputPath);
}
}
