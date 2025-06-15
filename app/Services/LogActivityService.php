<?php

namespace App\Services;

use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;

class LogActivityService
{
    public static function addLog($aktivitas)
    {
        $user = Auth::user();

        if ($user) {
            LogActivity::create([
                'id_user' => $user->id_user,
                'aktivitas' => $aktivitas
            ]);
        }
    }
}
