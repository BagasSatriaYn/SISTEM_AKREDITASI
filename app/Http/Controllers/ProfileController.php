<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $level = $user->level ?? 'Tidak Ada Level';
        return view('Profile/profile', compact('user', 'level'));
    }

    public function upload(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validasi file
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        // Simpan file ke storage
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('public/profile_pictures');
            $user->profile_picture = str_replace('public/', '', $path); // Simpan path relatif
            
        }

        return redirect()->route('profile.show')->with('success', 'Foto profil berhasil diunggah!');
    }
}