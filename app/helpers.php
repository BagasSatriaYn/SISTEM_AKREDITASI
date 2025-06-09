<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('routeDashboardByRole')) {
    function routeDashboardByRole()
    {
        $user = Auth::user();
        $level = $user->level->level_kode ?? '';

        if ($user->level->nama_level === 'SUPER') {
            return route('superadmin.user.index');
        }

        if (in_array($level, ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9'])) {
            return route('anggota.dashboard');
        }

        if ($user->level->nama_level === 'DIREKTUR') {
            return route('direktur.dashboard');
        }

        if ($user->level->nama_level === 'KAJUR') {
            return route('kajur.dashboard');
        }

        return '/';
    }
}
