<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kriteria;
use App\Services\NotificationService;
use App\Models\DetailKriteria;
use App\Models\Notification;


class AnggotaController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

  public function dashboard()
{
    $user = auth()->user();

    // Tambahkan notifikasi tes SETIAP kali dashboard dibuka
    // Notification::create([
    //     'user_id' => $user->id_user,
    //     'from_user_id' => $user->id_user,
    //     'kriteria_id' => 1,
    //     'type' => 'tes',
    //     'title' => 'Notif Tes Baru',
    //     'message' => 'Notifikasi ini dibuat manual dari dashboard',
    //     'is_read' => false,
    // ]);

    $dataKriteria = DetailKriteria::with('kriteria')->get();
    $notifications = Notification::where('user_id', $user->id_user)->latest()->take(5)->get();
    $unreadCount = Notification::where('user_id', $user->id_user)->where('is_read', false)->count();

    return view('anggota.dashboard', compact('dataKriteria', 'notifications', 'unreadCount'));
}
}