<?php

namespace App\Http\Controllers;

use App\Models\DetailKriteria;
use App\Models\Penetapan;
use App\Models\Pelaksanaan;
use App\Models\Evaluasi;
use App\Models\Pengendalian;
use App\Models\Peningkatan;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;

class DetailKriteriaController extends Controller
{
    public function index()
    {
        $detailKriteria = DetailKriteria::with([
            'penetapan', 
            'pelaksanaan', 
            'evaluasi', 
            'pengendalian', 
            'peningkatan', 
            'kriteria', 
            'komentar'
        ])->get();
        
        return response()->json([
            'success' => true,
            'data' => $detailKriteria
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kriteria' => 'required|exists:t_kriteria,id_kriteria',
            'penetapan' => 'required',
            'pendukung_penetapan' => 'required',
            'pelaksanaan' => 'required',
            'pendukung_pelaksanaan' => 'required',
            'evaluasi' => 'required',
            'pendukung_evaluasi' => 'required',
            'pengendalian' => 'required',
            'pendukung_pengendalian' => 'required',
            'peningkatan' => 'required',
            'pendukung_peningkatan' => 'required',
            'komentar' => 'nullable',
            'status_validator' => 'required|in:acc,gak,rev',
            'status_selesai' => 'required|in:save,submit',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            // Buat penetapan
            $penetapan = Penetapan::create([
                'penetapan' => $request->penetapan,
                'pendukung' => $request->pendukung_penetapan,
            ]);

            // Buat pelaksanaan
            $pelaksanaan = Pelaksanaan::create([
                'penetapan' => $request->pelaksanaan,
                'pendukung' => $request->pendukung_pelaksanaan,
            ]);

            // Buat evaluasi
            $evaluasi = Evaluasi::create([
                'penetapan' => $request->evaluasi,
                'pendukung' => $request->pendukung_evaluasi,
            ]);

            // Buat pengendalian
            $pengendalian = Pengendalian::create([
                'penetapan' => $request->pengendalian,
                'pendukung' => $request->pendukung_pengendalian,
            ]);

            // Buat peningkatan
            $peningkatan = Peningkatan::create([
                'penetapan' => $request->peningkatan,
                'pendukung' => $request->pendukung_peningkatan,
            ]);

            // Buat komentar jika ada
            $komentar = null;
            if ($request->filled('komentar')) {
                $komentar = Komentar::create([
                    'komentar' => $request->komentar,
                ]);
            }

            // Buat detail kriteria
            $detailKriteria = DetailKriteria::create([
                'id_penetapan' => $penetapan->id_penetapan,
                'id_pelaksanaan' => $pelaksanaan->id_pelaksanaan,
                'id_evaluasi' => $evaluasi->id_evaluasi,
                'id_pengendalian' => $pengendalian->id_pengendalian,
                'id_peningkatan' => $peningkatan->id_peningkatan,
                'id_kriteria' => $request->id_kriteria,
                'id_komentar' => $komentar ? $komentar->id_komentar : null,
                'status_validator' => $request->status_validator,
                'status_selesai' => $request->status_selesai,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Detail kriteria berhasil dibuat',
                'data' => $detailKriteria
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }

    }

    // Di fungsi update status
public function updateStatus(Request $request, $id)
{
    $detail = DetailKriteria::findOrFail($id);
    $oldStatus = $detail->status;

    $detail->status = $request->status;
    $detail->validated_by = Auth::user()->name;
    $detail->save();

    // Panggil notifikasi hanya jika status berubah
    if ($oldStatus !== $request->status) {
        NotificationController::storeNotification(
            $request->status,
            $detail->id_kriteria,
            Auth::user()->id_user
        );
    }

    return back()->with('success', 'Status diperbarui dan notifikasi dikirim.');
}
}
