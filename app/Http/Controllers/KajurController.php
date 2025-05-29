<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKriteria;
use App\Models\Kriteria;
use App\Models\Komentar;

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
        $data = DetailKriteria::findOrFail($request->id_kriteria);

        $data->status = $request->status_validasi === 'diterima' ? 'acc1' : 'revisi';
        $data->save();

        return response()->json(['success' => true, 'message' => 'Validasi Tahap 1 berhasil']);
    }

    /**
     * Daftar data untuk divalidasi Kajur.
     * Hanya tampilkan data dengan status 'submitted' atau 'revisi'
     */
    public function getDataValidasiTahap1()
    {
        $data = DetailKriteria::with('kriteria')
            ->whereIn('status', ['submitted', 'revisi'])
            ->get();

        return response()->json($data);
    }

    /**
     * Detail data validasi, termasuk info validator dan komentar
     */
    public function getDetailValidasi($id)
    {
        $detail = DetailKriteria::with(['kriteria', 'komentar'])->findOrFail($id);

        $validator = '-';
        $catatan = '-';

        if ($detail->status === 'acc1') {
            $validator = 'Kajur';
        } elseif ($detail->status === 'acc2') {
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