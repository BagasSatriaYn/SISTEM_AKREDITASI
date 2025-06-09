<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

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