<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\Kriteria;
use App\Models\DetailKriteria;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public static function storeNotification($status, $id_detail_kriteria, $from_user_id)
    {
        \Log::info("✅ storeNotification DIPANGGIL");

        $detail = DetailKriteria::with('kriteria')->find($id_detail_kriteria);
        if (!$detail) return;

        $kriteria_id = $detail->id_kriteria;
        $kriteriaNama = $detail->kriteria?->nama ?? 'Kriteria';
        $anggota_id = $detail->id_user;

        $fromUser = UserModel::with('level')->find($from_user_id);
        $levelKode = $fromUser?->level->level_kode;

        \Log::info("🔔 Notifikasi dipanggil | status: $status, kriteria: $kriteria_id, from: $from_user_id, level: $levelKode");

        // ANGGOTA kirim data → ke KAJUR
        if (str_starts_with($levelKode, 'A') && $status === 'submitted') {
            $kajur = UserModel::whereHas('level', fn($q) => $q->where('level_kode', 'KJR'))->first();

            if ($kajur) {
                Notification::create([
                    'user_id' => $kajur->id_user,
                    'from_user_id' => $from_user_id,
                    'kriteria_id' => $kriteria_id,
                    'type' => 'pengajuan',
                    'title' => 'Status Pengajuan',
                    'message' => "Data {$kriteriaNama} Anda sedang diajukan ke Kajur untuk validasi"
                ]);
            }

            // Konfirmasi ke diri sendiri
            Notification::create([
                'user_id' => $from_user_id,
                'from_user_id' => $from_user_id,
                'kriteria_id' => $kriteria_id,
                'type' => 'konfirmasi',
                'title' => 'Data Diserahkan',
                'message' => "Data {$kriteriaNama} berhasil dikirim ke Kajur"
            ]);
        }

        // KAJUR validasi → ke ANGGOTA + ke DIREKTUR
        elseif ($levelKode === 'KJR') {
            $direktur = UserModel::whereHas('level', fn($q) => $q->where('level_kode', 'DKT'))->first();

            if ($anggota_id) {
                $msg = $status === 'revisi'
                    ? "Pengajuan Anda ditolak oleh Kajur, silakan lakukan revisi"
                    : "Pengajuan Anda diterima oleh Kajur";

                Notification::create([
                    'user_id' => $anggota_id,
                    'from_user_id' => $from_user_id,
                    'kriteria_id' => $kriteria_id,
                    'type' => 'validasi_tahap_1',
                    'title' => 'Status Pengajuan',
                    'message' => $msg
                ]);
            }

            if ($status === 'acc1' && $direktur) {
                Notification::create([
                    'user_id' => $direktur->id_user,
                    'from_user_id' => $from_user_id,
                    'kriteria_id' => $kriteria_id,
                    'type' => 'pengajuan',
                    'title' => 'Validasi Tahap 2',
                    'message' => "Kajur telah menyetujui {$kriteriaNama}, silakan validasi"
                ]);
            }
        }

        // DIREKTUR validasi → ke ANGGOTA + ke KAJUR
        elseif ($levelKode === 'DKT') {
            $kajur = UserModel::whereHas('level', fn($q) => $q->where('level_kode', 'KJR'))->first();

            if ($anggota_id) {
                $msg = $status === 'revisi'
                    ? "Pengajuan Anda ditolak oleh Direktur, silakan lakukan revisi"
                    : "Pengajuan Anda diterima oleh Direktur";

                Notification::create([
                    'user_id' => $anggota_id,
                    'from_user_id' => $from_user_id,
                    'kriteria_id' => $kriteria_id,
                    'type' => 'validasi_tahap_2',
                    'title' => 'Status Pengajuan',
                    'message' => $msg
                ]);
            }

            if ($status === 'acc2' && $kajur) {
                Notification::create([
                    'user_id' => $kajur->id_user,
                    'from_user_id' => $from_user_id,
                    'kriteria_id' => $kriteria_id,
                    'type' => 'notifikasi_final',
                    'title' => 'Validasi Selesai',
                    'message' => "{$kriteriaNama} telah divalidasi oleh Direktur"
                ]);
            }
        }
    }




    public function index()
    {
        $notifications = $this->notificationService->getUserNotifications(Auth::user()->id_user);
        $unreadCount = $this->notificationService->getUnreadCount(Auth::user()->id_user);

        return response()->json([
            'success' => true,
            'data' => [
                'notifications' => $notifications,
                'unread_count' => $unreadCount
            ]
        ]);
    }

    public function getUnreadCount()
    {
        $unreadCount = $this->notificationService->getUnreadCount(Auth::user()->id_user);
        return response()->json(['success' => true, 'unread_count' => $unreadCount]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id_notification', $id)
            ->where('user_id', Auth::user()->id_user)
            ->first();

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan'], 404);
        }

        $notification->markAsRead();

        return response()->json(['success' => true, 'message' => 'Notifikasi ditandai sebagai dibaca']);
    }

    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead(Auth::user()->id_user);

        return response()->json(['success' => true, 'message' => 'Semua notifikasi ditandai sebagai dibaca']);
    }

    public function destroy($id)
    {
        $notification = Notification::where('id_notification', $id)
            ->where('user_id', Auth::user()->id_user)
            ->first();

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan'], 404);
        }

        $notification->delete();

        return response()->json(['success' => true, 'message' => 'Notifikasi berhasil dihapus']);
    }
}
