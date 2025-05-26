<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKriteria;
use App\Models\Kriteria;
use App\Models\Komentar; // tambahkan model Komentar
use Illuminate\Support\Facades\Auth;

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

    public function simpanValidasiTahap1(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|integer',
            'status_validasi' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $data = DetailKriteria::where('id_kriteria', $request->id_kriteria)->firstOrFail();

        // Simpan komentar
        $komentar = Komentar::create([
            'validator_id' => Auth::id(),
            'catatan' => $request->catatan,
        ]);

        $data->status = $request->status_validasi === 'diterima' ? 'acc1' : 'revisi';
        $data->id_komentar = $komentar->id;
        $data->save();

        return response()->json(['success' => true, 'message' => 'Validasi Tahap 1 berhasil']);
    }

    public function listValidasiTahap1(Request $request)
    {
        $data = DetailKriteria::with(['kriteria', 'user']) // sesuaikan relasi
            ->where('status', 'submit')
            ->get();

        return response()->json($data);
    }   

    public function getDataValidasiTahap1()
    {
        $data = DetailKriteria::with('kriteria')
            ->where('status', 'submitted')
            ->get();
        return response()->json($data);
    }
}
