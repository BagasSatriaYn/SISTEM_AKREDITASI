<?php
namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function getUserNotifications($userId)
    {
        return Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function getUnreadCount($userId)
    {
        return Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();
    }

    public function markAllAsRead($userId)
    {
        Notification::where('user_id', $userId)->update(['is_read' => true]);
    }
}
