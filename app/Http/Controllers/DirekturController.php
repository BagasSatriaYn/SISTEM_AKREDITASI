<?php

namespace App\Http\Controllers;
    
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailKriteria; // ← ini benar
use App\Models\Kriteria;
use App\Models\Komentar;


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
   public function simpanValidasiTahap2(Request $request)
{
    $request->validate([
        'id_kriteria' => 'required|exists:t_detail_kriteria,id_detail_kriteria',
        'status_validasi' => 'required|in:diterima,ditolak',
        'catatan' => 'nullable|string'
    ]);

    $detail = DetailKriteria::findOrFail($request->id_kriteria);

    // Simpan komentar dulu (jika ada)
    $komentar = null;
    if (!empty($request->catatan)) {
        $komentar = Komentar::create([
            'komen' => $request->catatan
        ]);
    }

    // Update status dan simpan id komentar jika ada
    $detail->status = $request->status_validasi === 'diterima' ? 'acc2' : 'revisi';
    if ($komentar) {
        $detail->id_komentar = $komentar->id_komentar;
    }
    $detail->save();

    return response()->json(['success' => true, 'message' => 'Validasi tahap 2 berhasil disimpan']);
}


 public function listValidasiTahap2(Request $request)
{
    $data = DetailKriteria::with(['kriteria', 'user']) // sesuaikan relasi
        ->where('status', 'submit')
        ->get();

    return response()->json($data);
}   

public function getDataValidasiTahap2()
{
    $data = DetailKriteria::with('kriteria')
        ->where('status', 'acc1') // atau 'acc tahap 1' jika enummu pakai spasi
        ->get();
    return response()->json($data);
}
    



}
