<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kriteria;


class NotificationController extends Controller
{
    protected $notificationService;

    public static function storeNotification($status, $kriteria_id, $from_user_id)
    {
        $fromUser = User::find($from_user_id);
        $kriteria = Kriteria::find($kriteria_id);
        $kriteriaNama = $kriteria->nama ?? 'Kriteria';

        // Admin: kirim ke Kajur
        if ($fromUser->level->level_nama === 'admin' && $status === 'submitted') {
            $kajur = User::whereHas('level', function ($q) {
                $q->where('level_nama', 'kajur');
            })->first();

            Notification::create([
                'user_id' => $kajur->id_user,
                'from_user_id' => $from_user_id,
                'kriteria_id' => $kriteria_id,
                'type' => 'pengajuan',
                'title' => 'Pengajuan Baru',
                'message' => "Anda menerima pengajuan {$kriteriaNama} dari {$fromUser->name}"
            ]);
        }

        // Kajur: kirim ke anggota dan direktur
        elseif ($fromUser->level->level_nama === 'kajur') {
            $anggota = User::find($from_user_id); // anggap dia submit sebelumnya
            $direktur = User::whereHas('level', function ($q) {
                $q->where('level_nama', 'direktur');
            })->first();

            $msg = "Pengajuan anda diterima oleh {$fromUser->name}";
            if ($status === 'revisi') {
                $msg .= ", Silahkan melakukan revisi";
            }

            foreach ([$anggota->id_user, $direktur->id_user] as $receiver) {
                Notification::create([
                    'user_id' => $receiver,
                    'from_user_id' => $from_user_id,
                    'kriteria_id' => $kriteria_id,
                    'type' => 'validasi_tahap_1',
                    'title' => 'Notifikasi Validasi Kajur',
                    'message' => $msg
                ]);
            }
        }

        // Direktur: kirim ke anggota
        elseif ($fromUser->level->level_nama === 'direktur') {
            $anggota = User::find($from_user_id);

            $msg = "Pengajuan anda diterima oleh {$fromUser->name}";
            if ($status === 'revisi') {
                $msg .= ", Silahkan melakukan revisi";
            }

            Notification::create([
                'user_id' => $anggota->id_user,
                'from_user_id' => $from_user_id,
                'kriteria_id' => $kriteria_id,
                'type' => 'validasi_tahap_2',
                'title' => 'Notifikasi Validasi Direktur',
                'message' => $msg
            ]);
        }
    }
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Dapatkan notifikasi untuk user yang sedang login
     */
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

    /**
     * Dapatkan jumlah notifikasi yang belum dibaca
     */
    public function getUnreadCount()
    {
        $unreadCount = $this->notificationService->getUnreadCount(Auth::user()->id_user);
        
        return response()->json([
            'success' => true,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Tandai notifikasi sebagai sudah dibaca
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('id_notification', $id)
            ->where('user_id', Auth::user()->id_user)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan'
            ], 404);
        }

        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil ditandai sebagai dibaca'
        ]);
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca
     */
    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead(Auth::user()->id_user);

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi berhasil ditandai sebagai dibaca'
        ]);
    }

    /**
     * Hapus notifikasi
     */
    public function destroy($id)
    {
        $notification = Notification::where('id_notification', $id)
            ->where('user_id', Auth::user()->id_user)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan'
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dihapus'
        ]);
    }
}