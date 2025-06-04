<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Niklasravnsborg\LaravelPdf\Facades\Pdf;

class DokumenFinalController extends Controller
{
    public function index()
    {
        $data = DetailKriteria::with('kriteria')
            ->where('status', 'acc2')
            
            ->get();

             foreach ($data as $detail) {
        $filename = 'dokumen_kriteria_' . $detail->id_detail_kriteria . '.pdf';
        $path = 'public/final/' . $filename;

        if (!Storage::exists($path)) {
            $pdf = Pdf::loadView('dokumen.template', compact('detail'));
            Storage::put($path, $pdf->output());
        }
    
        return view('DokumenFinal.final', [
            'title' => 'Dokumen Final',
            'data' => $data
        ]);
    }
}
   public function generatePdf($id)
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
