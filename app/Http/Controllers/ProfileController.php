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

    $request->validate([
        'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('profile')) {
        if ($user->profile) {
            Storage::delete('public/' . $user->profile);
        }

        $path = $request->file('profile')->store('public/profile_pictures');
        $user->profile = str_replace('public/', '', $path);

        $user->save(); // ✅ SIMPAN PERUBAHAN KE DATABASE
    }

    return redirect()->route('profile.show')->with('success', 'Foto profil berhasil diunggah!');
}
}   