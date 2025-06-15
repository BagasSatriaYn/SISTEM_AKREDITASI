<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKriteria;
use App\Models\Kriteria;
use App\Models\Komentar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\NotificationController;

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

    /**
     * Simpan validasi tahap 1 oleh Kajur.
     * - Jika diterima → status = 'acc1'
     * - Jika ditolak → status = 'revisi'
     */
   public function simpanValidasiTahap1(Request $request)
{
    $request->validate([
        'id_kriteria' => 'required|exists:t_detail_kriteria,id_detail_kriteria',
        'status_validasi' => 'required|in:diterima,ditolak',
        'catatan' => 'nullable|string'
    ]);

    $data = DetailKriteria::findOrFail($request->id_kriteria);

    $data->status = $request->status_validasi === 'diterima' ? 'acc1' : 'revisi';
    $data->validated_by = 'kajur';

    if (!empty($request->catatan)) {
        $komentar = Komentar::create(['komen' => $request->catatan]);
        $data->id_komentar = $komentar->id_komentar;
    }

    $data->save();

    // ✅ PEMANGGILAN DIBETULKAN
    NotificationController::storeNotification(
        $data->status,
        $data->id_detail_kriteria,
        auth()->user()->id_user
    );

    return response()->json(['success' => true, 'message' => 'Validasi Tahap 1 berhasil']);
}
    
    /**
     * Daftar data untuk divalidasi Kajur.
     * Menampilkan data dengan status 'submitted' atau 'revisi'
     */
    public function getDataValidasiTahap1()
    {
         $data = DetailKriteria::with(['kriteria:id_kriteria,nama'])
        ->whereIn('status', ['submitted', 'revisi'])
        ->get();

    return response()->json($data);
    }

    /**
     * Tampilkan detail validasi termasuk komentar dan validator
     */
   public function getDetailValidasi($id)
{
    $detail = DetailKriteria::with(['kriteria', 'komentar'])->findOrFail($id);

    $validator = '-';
    $catatan = '-';

    // ✅ Gunakan kolom validated_by langsung, bukan tebak-tebakan dari komentar
   $validator = '-';
    if ($detail->validated_by === 'kajur') {
        $validator = 'Kajur';
    } elseif ($detail->validated_by === 'direktur') {
        $validator = 'Direktur';
    }   


    if ($detail->komentar) {
        $catatan = $detail->komentar->komen;
    }

    return response()->json([
        'validator' => $validator,
        'status' => strtoupper($detail->status),
        'catatan' => $catatan,
        'pdf_url' => asset("storage/final/dokumen_kriteria_{$id}.pdf")
    ]);
}

    /**
     * Preview PDF sesuai ID
     */
    public function previewPdf($id)
    {
        Log::info("🔍 Masuk previewPdf() dengan ID: $id");

        $detail = DetailKriteria::with([
            'kriteria',
            'penetapan',
            'pelaksanaan',
            'evaluasi',
            'pengendalian',
            'peningkatan'
        ])->findOrFail($id);

        $viewName = 'kriteria' . $detail->kriteria->id_kriteria . '.export';

        try {
            return PDF::loadView($viewName, ['details' => $detail])
                ->stream('dokumen_ppepp.pdf');
        } catch (\Exception $e) {
            Log::error("❌ Gagal generate PDF: " . $e->getMessage());
            abort(500, 'PDF error');
        }
    }
}
