<?php
 
 namespace App\Http\Controllers; 
 
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 
 class AuthController extends Controller
 {
     public function login()    
     {
         if(Auth::check()){ // jika sudah login, maka redirect ke halaman home return redirect('/');
         }
             return view('auth.login');
     }
 
     public function postlogin(Request $request)
     {
         if($request->ajax() || $request->wantsJson()){
             $credentials = $request->only('username', 'password');
 
            if (Auth::attempt($credentials)) { 
            $user = Auth::user();
            $level = $user->level->level_kode;

            $redirectTo = match ($level) {
                'DKT' => url('/dashboard/direktur'),
                'SPI' => url('/dashboard/spi'),
                'KJR' => url('/dashboard/kajur'),
                'A1' => url('/kriteria1/index/anggota'),
                'A2' => url('/kriteria2/index/anggota'),
            };

            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil', 
                'redirect' => $redirectTo
            ]);
    }
 }
         return redirect('login');
     }
 
     public function logout(Request $request)
     {
         Auth::logout();
 
         $request->session()->invalidate();
         $request->session()->regenerateToken(); 
         return redirect('login');
     }
 }