<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /** Tampilkan form login dari layouts/login.blade.php */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/'); // atau route('home')
        }

        // view di resources/views/layouts/login.blade.php
        return view('layouts.login1');
    }

    /** Proses login, support AJAX & non‑AJAX */
    public function login(Request $request)
    {
        // validasi basic
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // jika AJAX/JSON
        if ($request->ajax() || $request->wantsJson()) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user  = Auth::user();
                $level = $user->level->level_kode ?? null;

                $redirectTo = match ($level) {
                    'DKT' => url('/dashboard/direktur'),
                    'SPI' => url('/dashboard/spi'),
                    'KJR' => url('/dashboard/kajur'),
                    'A1'  => url('/kriteria1/index/anggota'),
                    'A2'  => url('/kriteria2/index/anggota'),
                    'A3'  => url('/kriteria3/index/anggota'),
                    'A4'  => url('/kriteria4/index/anggota'),
                    'A5'  => url('/kriteria5/index/anggota'),
                    'A6'  => url('/kriteria6/index/anggota'),
                    'A7'  => url('/kriteria7/index/anggota'),
                    'A8'  => url('/kriteria8/index/anggota'),
                    'A9'  => url('/kriteria9/index/anggota'),
                    'SUPER'  => url('/superadmin/index'),
                    default => url('/'),
                };

                return response()->json([
                    'status'   => true,
                    'message'  => 'Login Berhasil',
                    'redirect' => $redirectTo,
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Username atau password salah',
            ], 401);
        }

        // non‑AJAX
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah'])
            ->withInput($request->only('username'));
    }

    /** Logout */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('layouts.login1')
            ->with('status', 'Anda telah berhasil logout'); 
            
    }
    public function showProfile()
{
    $user = Auth::user();
    return view('Profile.profile', [
        'user' => $user,
        'level' => $user->level->nama_level ?? 'Unknown Level'
    ]);
}
}
