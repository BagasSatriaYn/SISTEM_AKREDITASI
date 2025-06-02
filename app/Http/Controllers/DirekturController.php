<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKriteria;
use App\Models\Kriteria;
use App\Models\Komentar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

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

    /**
     * Simpan validasi tahap 2 oleh Direktur.
     * - Jika diterima → status = 'acc2'
     * - Jika ditolak → status = 'revisi'
     */
    public function simpanValidasiTahap2(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:t_detail_kriteria,id_detail_kriteria',
            'status_validasi' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string'
        ]);

        $detail = DetailKriteria::findOrFail($request->id_kriteria);
        $detail->status = $request->status_validasi === 'diterima' ? 'acc2' : 'revisi';
       if ($detail->validated_by !== 'kajur') {
        $detail->validated_by = 'direktur';
    }
 // ← Tandai bahwa Direktur yang validasi

        // Simpan komentar jika ada
        if (!empty($request->catatan)) {
            $komentar = Komentar::create([
                'komen' => $request->catatan
            ]);
            $detail->id_komentar = $komentar->id_komentar;
        }

        $detail->save();

        return response()->json(['success' => true, 'message' => 'Validasi tahap 2 berhasil disimpan']);
    }

    /**
     * Ambil data yang statusnya siap divalidasi tahap 2
     */
    public function getDataValidasiTahap2()
    {
        $data = DetailKriteria::with('kriteria')
            ->where('status', 'acc1')
            ->get();

        return response()->json($data);
    }

    /**
     * (Opsional) List semua yang sudah submit (kalau dibutuhkan)
     */
    public function listValidasiTahap2(Request $request)
    {
        $data = DetailKriteria::with(['kriteria', 'user']) // Pastikan relasi 'user' didefinisikan jika digunakan
            ->where('status', 'submit')
            ->get();

        return response()->json($data);
    }

    /**
     * Preview PDF untuk direktur (dokumen PPEPP)
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
