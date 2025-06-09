<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class DashboardController extends Controller
{
     public function index()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();
        
        // Data untuk dashboard
        $data = [
            'user' => $user,
            'userName' => $user->name,
            'userInitials' => $user->initials,
            'userRole' => $user->role_name,
            'notifications' => $this->getNotifications(),
            'notificationCount' => $this->getUnreadNotificationCount()
        ];
        
        return view('dashboard.admin', $data);
    }

    private function getNotifications()
    {
        // Contoh data notifikasi - bisa diganti dengan query database
        return [
            [
                'title' => 'Data kriteria baru ditambahkan',
                'message' => 'Kriteria "Kemampuan Teknis" telah berhasil ditambahkan ke sistem',
                'time' => '2 menit yang lalu',
                'is_read' => false
            ],
            [
                'title' => 'Update sistem berhasil',
                'message' => 'Sistem telah diperbarui ke versi terbaru',
                'time' => '1 jam yang lalu',
                'is_read' => false
            ],
            [
                'title' => 'Backup data selesai',
                'message' => 'Backup harian telah berhasil diselesaikan',
                'time' => '3 jam yang lalu',
                'is_read' => false
            ],
            [
                'title' => 'Login berhasil',
                'message' => 'Anda berhasil masuk ke sistem',
                'time' => '5 jam yang lalu',
                'is_read' => true
            ]
        ];
    }

    private function getUnreadNotificationCount()
    {
        return count(array_filter($this->getNotifications(), function($notification) {
            return !$notification['is_read'];
        }));
    }
}