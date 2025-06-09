<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Kriteria;

class NotificationService
{
    /**
     * Kirim notifikasi ketika ada submission dari admin ke kajur
     */
    public function sendSubmissionNotification($kriteriaId, $fromUserId)
    {
        $kriteria = Kriteria::find($kriteriaId);
        $fromUser = User::with('level')->find($fromUserId);
        
        // Cari user dengan role kajur
        $kajurUsers = User::whereHas('level', function($query) {
            $query->where('level_nama', 'kajur');
        })->get();

        foreach ($kajurUsers as $kajur) {
            Notification::create([
                'user_id' => $kajur->id_user,
                'from_user_id' => $fromUserId,
                'kriteria_id' => $kriteriaId,
                'type' => 'submission',
                'title' => 'Pengajuan Kriteria Baru',
                'message' => "Anda menerima pengajuan Kriteria {$kriteria->nama} dari {$fromUser->name}"
            ]);
        }
    }

    /**
     * Kirim notifikasi ketika kajur menyetujui/menolak
     */
    public function sendKajurDecisionNotification($kriteriaId, $fromUserId, $toUserId, $isApproved, $isRevision = false)
    {
        $kriteria = Kriteria::find($kriteriaId);
        $fromUser = User::with('level')->find($fromUserId);
        
        if ($isRevision) {
            $message = "Pengajuan anda ditolak oleh {$fromUser->name}, Silahkan melakukan revisi";
            $title = "Pengajuan Ditolak - Perlu Revisi";
            $type = 'revision';
        } elseif ($isApproved) {
            $message = "Pengajuan anda diterima oleh {$fromUser->name}";
            $title = "Pengajuan Diterima - Validasi Tahap 1";
            $type = 'approval';
        } else {
            $message = "Pengajuan anda ditolak oleh {$fromUser->name}";
            $title = "Pengajuan Ditolak";
            $type = 'rejection';
        }

        // Kirim ke anggota yang mengajukan
        Notification::create([
            'user_id' => $toUserId,
            'from_user_id' => $fromUserId,
            'kriteria_id' => $kriteriaId,
            'type' => $type,
            'title' => $title,
            'message' => $message
        ]);

        // Jika disetujui kajur, kirim juga ke direktur
        if ($isApproved && !$isRevision) {
            $direkturUsers = User::whereHas('level', function($query) {
                $query->where('level_nama', 'direktur');
            })->get();

            foreach ($direkturUsers as $direktur) {
                Notification::create([
                    'user_id' => $direktur->id_user,
                    'from_user_id' => $fromUserId,
                    'kriteria_id' => $kriteriaId,
                    'type' => 'forwarded',
                    'title' => 'Pengajuan untuk Validasi Tahap 2',
                    'message' => "Pengajuan Kriteria {$kriteria->nama} telah disetujui oleh {$fromUser->name} dan memerlukan validasi tahap 2"
                ]);
            }
        }
    }

    /**
     * Kirim notifikasi ketika direktur menyetujui/menolak
     */
    public function sendDirekturDecisionNotification($kriteriaId, $fromUserId, $toUserId, $isApproved, $isRevision = false)
    {
        $kriteria = Kriteria::find($kriteriaId);
        $fromUser = User::with('level')->find($fromUserId);
        
        if ($isRevision) {
            $message = "Pengajuan anda ditolak oleh {$fromUser->name}, Silahkan melakukan revisi";
            $title = "Pengajuan Ditolak - Perlu Revisi";
            $type = 'revision';
        } elseif ($isApproved) {
            $message = "Pengajuan anda diterima oleh {$fromUser->name} - Validasi Tahap 2 Selesai";
            $title = "Pengajuan Diterima - Final";
            $type = 'final_approval';
        } else {
            $message = "Pengajuan anda ditolak oleh {$fromUser->name}";
            $title = "Pengajuan Ditolak - Final";
            $type = 'final_rejection';
        }

        // Kirim ke anggota yang mengajukan
        Notification::create([
            'user_id' => $toUserId,
            'from_user_id' => $fromUserId,
            'kriteria_id' => $kriteriaId,
            'type' => $type,
            'title' => $title,
            'message' => $message
        ]);

        // Kirim juga ke kajur untuk informasi
        $kajurUsers = User::whereHas('level', function($query) {
            $query->where('level_nama', 'kajur');
        })->get();

        foreach ($kajurUsers as $kajur) {
            Notification::create([
                'user_id' => $kajur->id_user,
                'from_user_id' => $fromUserId,
                'kriteria_id' => $kriteriaId,
                'type' => 'info',
                'title' => 'Update Validasi Tahap 2',
                'message' => "Kriteria {$kriteria->nama} telah " . ($isApproved ? 'disetujui' : 'ditolak') . " oleh {$fromUser->name} pada validasi tahap 2"
            ]);
        }
    }

    /**
     * Dapatkan notifikasi untuk user tertentu
     */
    public function getUserNotifications($userId, $limit = 10)
    {
        return Notification::with(['fromUser.level', 'kriteria'])
            ->forUser($userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Hitung notifikasi yang belum dibaca
     */
    public function getUnreadCount($userId)
    {
        return Notification::forUser($userId)->unread()->count();
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca
     */
    public function markAllAsRead($userId)
    {
        Notification::forUser($userId)->unread()->update(['is_read' => true]);
    }
}