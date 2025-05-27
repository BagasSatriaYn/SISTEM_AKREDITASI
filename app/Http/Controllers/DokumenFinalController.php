<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailKriteria;

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
    $detail = DetailKriteria::with([
        'penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan', 'kriteria'
    ])
    ->where('id_detail_kriteria', $id)
    ->where('status', 'acc2')
    ->firstOrFail();

    $pdf = Pdf::loadView('dokumen.template', compact('detail'));

    $filename = 'dokumen_kriteria_' . $id . '.pdf';

    // Simpan ke storage/app/public/final
    Storage::disk('public')->put('final/' . $filename, $pdf->output());

    return response()->json(['message' => 'PDF berhasil dibuat dan disimpan.']);
}

}
