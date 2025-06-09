<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKriteria;
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
    $finalisasiIds = DetailKriteria::select('id_finalisasi')
        ->distinct()
        ->orderBy('id_finalisasi', 'desc')
        ->get();

    return view('DokumenFinal.index', compact('finalisasiIds'));
}


    /**
     * Simpan validasi tahap 2 oleh Direktur.
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

        if (!empty($request->catatan)) {
            $komentar = Komentar::create(['komen' => $request->catatan]);
            $detail->id_komentar = $komentar->id_komentar;
        }

        $detail->save();

        return response()->json(['success' => true, 'message' => 'Validasi tahap 2 berhasil disimpan']);
    }

    /**
     * Ambil data yang statusnya siap divalidasi tahap 2.
     */
    public function getDataValidasiTahap2()
    {
        $data = DetailKriteria::with('kriteria')
            ->where('status', 'acc1')
            ->get();

        return response()->json($data);
    }

    /**
     * List semua yang sudah submit (optional).
     */
    public function listValidasiTahap2(Request $request)
    {
        $data = DetailKriteria::with(['kriteria', 'user'])
            ->where('status', 'submit')
            ->get();

        return response()->json($data);
    }

    /**
     * Preview PDF untuk direktur (dokumen PPEPP) per kriteria.
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

    /**
     * Preview finalisasi lengkap dalam format JSON.
     */
    public function previewFinalisasi($idFinalisasi)
    {
        $details = DetailKriteria::with([
            'kriteria',
            'komentar',
            'penetapan',
            'pelaksanaan',
            'evaluasi',
            'pengendalian',
            'peningkatan'
        ])
            ->where('id_finalisasi', $idFinalisasi)
            ->get();

        if ($details->isEmpty()) {
            return response()->json(['message' => 'Data finalisasi tidak ditemukan.'], 404);
        }

        $result = $details->map(function ($detail) {
            $validator = '-';
            if ($detail->status === 'acc1') {
                $validator = 'Kajur';
            } elseif ($detail->status === 'acc2') {
                $validator = 'Direktur';
            } elseif ($detail->status === 'revisi') {
                $validator = 'Revisi';
            }

            return [
                'id_detail_kriteria' => $detail->id_detail_kriteria,
                'nama_kriteria' => $detail->kriteria?->nama_kriteria ?? '-',
                'status' => strtoupper($detail->status),
                'validator' => $validator,
                'catatan' => $detail->komentar?->komen ?? '-',
                'penetapan' => $detail->penetapan ?? null,
                'pelaksanaan' => $detail->pelaksanaan ?? null,
                'evaluasi' => $detail->evaluasi ?? null,
                'pengendalian' => $detail->pengendalian ?? null,
                'peningkatan' => $detail->peningkatan ?? null,
            ];
        });

        return response()->json(['id_finalisasi' => $idFinalisasi, 'details' => $result]);
    }

    /**
     * Preview PDF gabungan finalisasi lengkap.
     */
    public function previewFinalisasiPdf($idFinalisasi)
    {
        $details = DetailKriteria::with([
            'kriteria',
            'komentar',
            'penetapan',
            'pelaksanaan',
            'evaluasi',
            'pengendalian',
            'peningkatan'
        ])
            ->where('id_finalisasi', $idFinalisasi)
            ->get();

        if ($details->isEmpty()) {
            abort(404, 'Data finalisasi tidak ditemukan.');
        }

        $pdf = Pdf::loadView('DokumenFinal.finalisasi_pdf', [
            'details' => $details,
            'idFinalisasi' => $idFinalisasi,
        ]);

        return $pdf->stream("finalisasi_{$idFinalisasi}.pdf");
    }

    /**
     * Preview finalisasi PDF terbaru.
     */
    public function previewFinalisasiLast()
    {
        $lastFinalisasi = DetailKriteria::orderBy('id_finalisasi', 'desc')
            ->pluck('id_finalisasi')
            ->first();

        if (!$lastFinalisasi) {
            abort(404, 'Data finalisasi tidak ditemukan.');
        }

        return $this->previewFinalisasiPdf($lastFinalisasi);
    }

     public function getDetailValidasi($id)
{
    $detail = DetailKriteria::with(['kriteria', 'komentar'])->findOrFail($id);

    $validator = '-';
    $catatan = '-';

    // ✅ Gunakan kolom validated_by langsung, bukan tebak-tebakan dari komentar
   $validator = '-';
    if ($detail->validated_by === 'direktur') {
        $validator = 'Direktur';
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

}
