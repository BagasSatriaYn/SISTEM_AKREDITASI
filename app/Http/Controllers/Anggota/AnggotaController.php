<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kriteria;
use App\Services\NotificationService;
use App\Models\DetailKriteria;
use App\Models\Notification;
use App\Services\LogActivityService;



class AnggotaController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

 public function dashboard()
{
    $userId = auth()->user()->id_user;

    $details = DetailKriteria::where('id_user', $userId)->get();

    $total = $details->count();
    $submitted = $details->where('status', 'submitted')->count();
    $acc1 = $details->where('status', 'acc1')->count();
    $acc2 = $details->where('status', 'acc2')->count();

    // Hitung total progress
    $totalProgress = 0;

    foreach ($details as $item) {
        switch ($item->status) {
            case 'acc2':
                $totalProgress += 100;
                break;
            case 'acc1':
                $totalProgress += 75;
                break;
            case 'submitted':
                $totalProgress += 50;
                break;
            default: // draft / save
                $totalProgress += 25;
                break;
        }
    }

    $averageProgress = $total > 0 ? $totalProgress / $total : 0;

    // Notifikasi (anggap ada servicenya)
    $notifications = app(\App\Services\NotificationService::class)->getUserNotifications($userId);

    return view('anggota.dashboard', compact('total', 'submitted', 'acc1', 'acc2', 'averageProgress', 'notifications'));
}
}   