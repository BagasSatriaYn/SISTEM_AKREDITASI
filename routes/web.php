<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\SuperuserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuperlevelController;
use App\Http\Controllers\KriteriaDuaController;
use App\Http\Controllers\DokumenFinalController;
use App\Http\Controllers\KriteriaEnamController;
use App\Http\Controllers\KriteriaLimaController;
use App\Http\Controllers\KriteriaSatuController;
use App\Http\Controllers\KriteriaTigaController;
use App\Http\Controllers\KriteriaEmpatController;
use App\Http\Controllers\KriteriaTujuhController;
use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\KriteriaDelapanController;
use App\Http\Controllers\KriteriaSembilanController;
use App\Http\Controllers\ProfileController;
use App\Services\NotificationService;
use App\Http\Controllers\SuperkriteriaController;
use App\Http\Controllers\SuperadminController;


/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::pattern('id', '[0-9]+'); //artinya ketika parameter {id}, maka harus berupa angka
 
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/login1', function () {
    return view('layouts.login1');
})->name('login');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');


Route::get('/', function () {
    return view('index');
});

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show')->middleware('auth');   
Route::get('/profil', [ProfileController::class, 'show'])->name('profil')->middleware('auth');
Route::post('/profil/upload', [ProfileController::class, 'upload'])->name('profile.upload')->middleware('auth');
Route::get('/anggota/dashboard', [AnggotaController::class, 'dashboard'])
    ->middleware('auth') // atau tambah role check jika ada
    ->name('anggota.dashboard');

    // Notifikasi: tandai semua sebagai telah dibaca
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications/mark-as-read', function () {
        app(\App\Services\NotificationService::class)->markAllAsRead(auth()->user()->id_user);
        return response()->json(['success' => true]);
    })->name('notifications.readall');
    Route::get('/test-notif', function () {
    \App\Http\Controllers\NotificationController::storeNotification('submitted', 1, 1);
    return 'Notifikasi tes dikirim!';
});

});

//SuperAdmin Routes
Route::middleware(['auth','authorize:SUPER'])->prefix('superadmin')->group(function () {
    Route::get('/superadmin/dashboard', [App\Http\Controllers\SuperadminController::class, 'dashboard'])->name('superadmin.dashboard');

    //KELOLA USER
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/user', [SuperuserController::class, 'index'])->name('superadmin.user.index');
    Route::get('/level', [SuperlevelController::class, 'index'])->name('superadmin.level.index');
    Route::post('/userlist', [SuperuserController::class, 'list'])->name('superadmin.user.list');
    Route::get('/userinput', [SuperuserController::class, 'input'])->name('superadmin.user.input');
    Route::post('/userstore', [SuperuserController::class, 'store'])->name('superadmin.user.store');
    Route::post('/list', [SuperlevelController::class, 'list'])->name('superadmin.level.list');
    Route::get('/user/{id}/show', [SuperuserController::class, 'show'])->name('superadmin.user.show');
    Route::get('/user/{id}/edit', [SuperuserController::class, 'edit'])->name('superadmin.user.edit');
    Route::post('/user/{id}/update', [SuperuserController::class, 'update'])->name('superadmin.user.update');
    Route::delete('/user/{id}/delete', [SuperuserController::class, 'destroy'])->name('superadmin.user.destroy');

    //Kelola Level
    Route::get('/level', [SuperlevelController::class, 'index'])->name('superadmin.level.index');
    Route::get('/levelinput', [SuperlevelController::class, 'input'])->name('superadmin.level.input');
    Route::post('/levellist', [SuperlevelController::class, 'list'])->name('superadmin.level.list');
    Route::get('/level/{id}', [SuperlevelController::class, 'show'])->name('superadmin.level.show');
    Route::post('/levelstore', [SuperlevelController::class, 'store'])->name('superadmin.level.store');
    Route::get('/level/{id}/edit', [SuperlevelController::class, 'edit'])->name('superadmin.level.edit');
    Route::post('/level/{id}/update', [SuperlevelController::class, 'update'])->name('superadmin.level.update');
    Route::delete('/level/{id}/delete', [SuperlevelController::class, 'destroy'])->name('superadmin.level.destroy');

    //Kelola Kriteria 
    Route::get('/kriteria', [App\Http\Controllers\SuperkriteriaController::class, 'index'])->name('superadmin.kriteria.index');
    Route::post('/kriterialist', [App\Http\Controllers\SuperkriteriaController::class, 'list'])->name('superadmin.kriteria.list');
    Route::get('/kriteriainput', [App\Http\Controllers\SuperkriteriaController::class, 'input'])->name('superadmin.kriteria.input');
    Route::get('/kriteria/{id}/show', [App\Http\Controllers\SuperkriteriaController::class, 'show'])->name('superadmin.kriteria.show');

    Route::post('/kriteriastore', [App\Http\Controllers\SuperkriteriaController::class, 'store'])->name('superadmin.kriteria.store');
    Route::get('/kriteria/{id}/edit', [App\Http\Controllers\SuperkriteriaController::class, 'edit'])->name('superadmin.kriteria.edit');
    Route::post('/kriteria/{id}/update', [App\Http\Controllers\SuperkriteriaController::class, 'update'])->name('superadmin.kriteria.update');
    Route::delete('/kriteria/{id}/delete', [App\Http\Controllers\SuperkriteriaController::class, 'destroy'])->name('superadmin.kriteria.destroy');

    
});

Route::middleware(['auth','authorize:A1'])->prefix('kriteria1')->group(function () {
    Route::get('/preview/{id}', [KriteriaSatuController::class, 'preview'])->name('kriteria1.preview');
    Route::get('/kriteria/{id}/preview', [KriteriaSatuController::class, 'preview']);
    Route::get('/{id}/preview/json', [KriteriaSatuController::class, 'getPreviewData'])->name('kriteria1.preview.data');
    Route::get('/anggota/dashboard', [KriteriaSatuController::class,'dashboard'])->name('kriteria1.dashboard');


    Route::get('/index/anggota', [WelcomeController::class, 'index']);
    Route::get('/index', [KriteriaSatuController::class, 'index'])->name('kriteria1.index'); 
    Route::post('/list', [KriteriaSatuController::class, 'list'])->name('kriteria1.list');

    Route::get('/input', [KriteriaSatuController::class, 'create']);    
    Route::post('/store', [KriteriaSatuController::class, 'store']);
    Route::post('/upload', [KriteriaSatuController::class, 'uploadImage'])->name('image.upload');
    Route::post('/upload', [KriteriaSatuController::class, 'uploadImage'])->name('kriteria1.upload');


    // ⬇️ PUT harus di atas ini!
    Route::put('/{id}/update', [KriteriaSatuController::class, 'update'])->name('kriteria1.update');

    // route wildcard diletakkan terakhir
    Route::get('/{id}/show', [KriteriaSatuController::class, 'show']);
    Route::get('/{id}/edit', [KriteriaSatuController::class, 'edit'])->name('kriteria1.edit');
    Route::get('/{id}/delete', [KriteriaSatuController::class, 'confirm']);
    Route::delete('/{id}/delete', [KriteriaSatuController::class, 'delete'])->name('kriteria1.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});

Route::middleware(['auth','authorize:A2'])->prefix('kriteria2')->group(function () {
    Route::get('/preview/{id}', [KriteriaDuaController::class, 'preview'])->name('kriteria2.preview');
    Route::get('/kriteria/{id}/preview', [KriteriaDuaController::class, 'preview']);
    Route::get('/{id}/preview/json', [KriteriaDuaController::class, 'getPreviewData'])->name('kriteria2.preview.data');


    Route::get('/index/anggota', [WelcomeController::class, 'index']);
    Route::get('/index', [KriteriaDuaController::class, 'index'])->name('kriteria2.index'); 
    Route::post('/list', [KriteriaDuaController::class, 'list'])->name('kriteria2.list');

    Route::get('/input', [KriteriaDuaController::class, 'create']);    
    Route::post('/store', [KriteriaDuaController::class, 'store']);
    Route::post('/upload', [KriteriaDuaController::class, 'uploadImage'])->name('image.upload');

    // ⬇️ PUT harus di atas ini!
    Route::put('/{id}/update', [KriteriaDuaController::class, 'update'])->name('kriteria2.update');

    // route wildcard diletakkan terakhir
    Route::get('/{id}/show', [KriteriaDuaController::class, 'show']);
    Route::get('/{id}/edit', [KriteriaDuaController::class, 'edit'])->name('kriteria2.edit');
    Route::get('/{id}/delete', [KriteriaDuaController::class, 'confirm']);
    Route::delete('/{id}/delete', [KriteriaDuaController::class, 'delete'])->name('kriteria2.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});

Route::middleware(['auth','authorize:A3'])->prefix('kriteria3')->group(function () {
    Route::get('/preview/{id}', [KriteriaTigaController::class, 'preview'])->name('kriteria3.preview');
    Route::get('/kriteria/{id}/preview', [KriteriaTigaController::class, 'preview']);
    Route::get('/{id}/preview/json', [KriteriaTigaController::class, 'getPreviewData'])->name('kriteria3.preview.data');

    Route::get('/index/anggota', [WelcomeController::class, 'index']);
    Route::get('/index', [KriteriaTigaController::class, 'index'])->name('kriteria3.index'); 
    Route::post('/list', [KriteriaTigaController::class, 'list'])->name('kriteria3.list');

    Route::get('/input', [KriteriaTigaController::class, 'create']);    
    Route::post('/store', [KriteriaTigaController::class, 'store']);
    Route::post('/upload', [KriteriaTigaController::class, 'uploadImage'])->name('image.upload');

    // ⬇️ PUT harus di atas ini!
    Route::put('/{id}/update', [KriteriaTigaController::class, 'update'])->name('kriteria3.update');

    // route wildcard diletakkan terakhir
    Route::get('/{id}/show', [KriteriaTigaController::class, 'show']);
    Route::get('/{id}/edit', [KriteriaTigaController::class, 'edit'])->name('kriteria3.edit');
    Route::get('/{id}/delete', [KriteriaTigaController::class, 'confirm']);
    Route::delete('/{id}/delete', [KriteriaTigaController::class, 'delete'])->name('kriteria3.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});

Route::middleware(['auth','authorize:A4'])->prefix('kriteria4')->group(function () {
    Route::get('/preview/{id}', [KriteriaEmpatController::class, 'preview'])->name('kriteria4.preview');
    Route::get('/kriteria/{id}/preview', [KriteriaEmpatController::class, 'preview']);
    Route::get('/{id}/preview/json', [KriteriaEmpatController::class, 'getPreviewData'])->name('kriteria4.preview.data');

    Route::get('/index/anggota', [WelcomeController::class, 'index']);
    Route::get('/index', [KriteriaEmpatController::class, 'index'])->name('kriteria4.index'); 
    Route::post('/list', [KriteriaEmpatController::class, 'list'])->name('kriteria4.list');

    Route::get('/input', [KriteriaEmpatController::class, 'create']);    
    Route::post('/store', [KriteriaEmpatController::class, 'store']);
    Route::post('/upload', [KriteriaEmpatController::class, 'uploadImage'])->name('image.upload');

    // ⬇️ PUT harus di atas ini!
    Route::put('/{id}/update', [KriteriaEmpatController::class, 'update'])->name('kriteria4.update');

    // route wildcard diletakkan terakhir
    Route::get('/{id}/show', [KriteriaEmpatController::class, 'show']);
    Route::get('/{id}/edit', [KriteriaEmpatController::class, 'edit'])->name('kriteria4.edit');
    Route::get('/{id}/delete', [KriteriaEmpatController::class, 'confirm']);
    Route::delete('/{id}/delete', [KriteriaEmpatController::class, 'delete'])->name('kriteria4.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});

Route::middleware(['auth','authorize:A5'])->prefix('kriteria5')->group(function () {
    Route::get('/preview/{id}', [KriteriaLimaController::class, 'preview'])->name('kriteria5.preview');
    Route::get('/kriteria/{id}/preview', [KriteriaLimaController::class, 'preview']);
    Route::get('/{id}/preview/json', [KriteriaLimaController::class, 'getPreviewData'])->name('kriteria5.preview.data');

    Route::get('/index/anggota', [WelcomeController::class, 'index']);
    Route::get('/index', [KriteriaLimaController::class, 'index'])->name('kriteria5.index'); 
    Route::post('/list', [KriteriaLimaController::class, 'list'])->name('kriteria5.list');

    Route::get('/input', [KriteriaLimaController::class, 'create']);    
    Route::post('/store', [KriteriaLimaController::class, 'store']);
    Route::post('/upload', [KriteriaLimaController::class, 'uploadImage'])->name('image.upload');

    // ⬇️ PUT harus di atas ini!
    Route::put('/{id}/update', [KriteriaLimaController::class, 'update'])->name('kriteria5.update');

    // route wildcard diletakkan terakhir
    Route::get('/{id}/show', [KriteriaLimaController::class, 'show']);
    Route::get('/{id}/edit', [KriteriaLimaController::class, 'edit'])->name('kriteria5.edit');
    Route::get('/{id}/delete', [KriteriaLimaController::class, 'confirm']);
    Route::delete('/{id}/delete', [KriteriaLimaController::class, 'delete'])->name('kriteria5.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});


Route::middleware(['auth','authorize:A6'])->prefix('kriteria6')->group(function () {
Route::get('/preview/{id}', [KriteriaEnamController::class, 'preview'])->name('kriteria6.preview');
Route::get('/kriteria/{id}/preview', [KriteriaEnamController::class, 'preview']);
Route::get('/{id}/preview/json', [KriteriaEnamController::class, 'getPreviewData'])->name('kriteria6.preview.data');

Route::get('/index/anggota', [WelcomeController::class, 'index']);
Route::get('/index', [KriteriaEnamController::class, 'index'])->name('kriteria6.index'); 
Route::post('/list', [KriteriaEnamController::class, 'list'])->name('kriteria6.list');

Route::get('/input', [KriteriaEnamController::class, 'create']);    
Route::post('/store', [KriteriaEnamController::class, 'store']);
Route::post('/upload', [KriteriaEnamController::class, 'uploadImage'])->name('image.upload');

// ⬇️ PUT harus di atas ini!
Route::put('/{id}/update', [KriteriaEnamController::class, 'update'])->name('kriteria6.update');

// route wildcard diletakkan terakhir
Route::get('/{id}/show', [KriteriaEnamController::class, 'show']);
Route::get('/{id}/edit', [KriteriaEnamController::class, 'edit'])->name('kriteria6.edit');
Route::get('/{id}/delete', [KriteriaEnamController::class, 'confirm']);
Route::delete('/{id}/delete', [KriteriaEnamController::class, 'delete'])->name('kriteria6.delete');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});

Route::middleware(['auth','authorize:A7'])->prefix('kriteria7')->group(function () {
Route::get('/preview/{id}', [KriteriaTujuhController::class, 'preview'])->name('kriteria7.preview');
Route::get('/kriteria/{id}/preview', [KriteriaTujuhController::class, 'preview']);
Route::get('/{id}/preview/json', [KriteriaTujuhController::class, 'getPreviewData'])->name('kriteria7.preview.data');

Route::get('/index/anggota', [WelcomeController::class, 'index']);
Route::get('/index', [KriteriaTujuhController::class, 'index'])->name('kriteria7.index'); 
Route::post('/list', [KriteriaTujuhController::class, 'list'])->name('kriteria7.list');

Route::get('/input', [KriteriaTujuhController::class, 'create']);    
Route::post('/store', [KriteriaTujuhController::class, 'store']);
Route::post('/upload', [KriteriaTujuhController::class, 'uploadImage'])->name('image.upload');

// ⬇️ PUT harus di atas ini!
Route::put('/{id}/update', [KriteriaTujuhController::class, 'update'])->name('kriteria7.update');

// route wildcard diletakkan terakhir
Route::get('/{id}/show', [KriteriaTujuhController::class, 'show']);
Route::get('/{id}/edit', [KriteriaTujuhController::class, 'edit'])->name('kriteria7.edit');
Route::get('/{id}/delete', [KriteriaTujuhController::class, 'confirm']);
Route::delete('/{id}/delete', [KriteriaTujuhController::class, 'delete'])->name('kriteria7.delete');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});

Route::middleware(['auth','authorize:A8'])->prefix('kriteria8')->group(function () {
Route::get('/preview/{id}', [KriteriaDelapanController::class, 'preview'])->name('kriteria8.preview');
Route::get('/kriteria/{id}/preview', [KriteriaDelapanController::class, 'preview']);
Route::get('/{id}/preview/json', [KriteriaDelapanController::class, 'getPreviewData'])->name('kriteria8.preview.data');

Route::get('/index/anggota', [WelcomeController::class, 'index']);
Route::get('/index', [KriteriaDelapanController::class, 'index'])->name('kriteria8.index'); 
Route::post('/list', [KriteriaDelapanController::class, 'list'])->name('kriteria8.list');

Route::get('/input', [KriteriaDelapanController::class, 'create']);    
Route::post('/store', [KriteriaDelapanController::class, 'store']);
Route::post('/upload', [KriteriaDelapanController::class, 'uploadImage'])->name('image.upload');

// ⬇️ PUT harus di atas ini!
Route::put('/{id}/update', [KriteriaDelapanController::class, 'update'])->name('kriteria8.update');

// route wildcard diletakkan terakhir
Route::get('/{id}/show', [KriteriaDelapanController::class, 'show']);
Route::get('/{id}/edit', [KriteriaDelapanController::class, 'edit'])->name('kriteria8.edit');
Route::get('/{id}/delete', [KriteriaDelapanController::class, 'confirm']);
Route::delete('/{id}/delete', [KriteriaDelapanController::class, 'delete'])->name('kriteria8.delete');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});
Route::middleware(['auth','authorize:A9'])->prefix('kriteria9')->group(function () {
Route::get('/preview/{id}', [KriteriaSembilanController::class, 'preview'])->name('kriteria9.preview');
Route::get('/kriteria/{id}/preview', [KriteriaSembilanController::class, 'preview']);
Route::get('/{id}/preview/json', [KriteriaSembilanController::class, 'getPreviewData'])->name('kriteria9.preview.data');

Route::get('/index/anggota', [WelcomeController::class, 'index']);
Route::get('/index', [KriteriaSembilanController::class, 'index'])->name('kriteria9.index'); 
Route::post('/list', [KriteriaSembilanController::class, 'list'])->name('kriteria9.list');

Route::get('/input', [KriteriaSembilanController::class, 'create']);    
Route::post('/store', [KriteriaSembilanController::class, 'store']);
Route::post('/upload', [KriteriaSembilanController::class, 'uploadImage'])->name('image.upload');

// ⬇️ PUT harus di atas ini!
Route::put('/{id}/update', [KriteriaSembilanController::class, 'update'])->name('kriteria9.update');

// route wildcard diletakkan terakhir
Route::get('/{id}/show', [KriteriaSembilanController::class, 'show']);
Route::get('/{id}/edit', [KriteriaSembilanController::class, 'edit'])->name('kriteria9.edit');
Route::get('/{id}/delete', [KriteriaSembilanController::class, 'confirm']);
Route::delete('/{id}/delete', [KriteriaSembilanController::class, 'delete'])->name('kriteria9.delete');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');

});
    Route::middleware(['auth', 'authorize:KJR'])->group(function () {
    Route::get('/dashboard/kajur', [KajurController::class, 'dashboard'])->name('kajur.dashboard');

    Route::prefix('kriteria')->group(function () {
        Route::get('/', [KajurController::class, 'index'])->name('kajur.kriteria.index');
        Route::get('/{id}/detail', [KajurController::class, 'show'])->name('kajur.kriteria.show');
        Route::post('/{id}/komentar', [KajurController::class, 'komentar'])->name('kajur.kriteria.komentar');
        Route::post('/{id}/validasi', [KajurController::class, 'validasi'])->name('kajur.kriteria.validasi');

        Route::view('/validasi1', 'validasi.validasi1')->name('validasi1');
        Route::get('/validasi1/list', [KajurController::class, 'listValidasiTahap1'])->name('validasi1.list');
        Route::post('/validasi1/simpan', [KajurController::class, 'simpanValidasiTahap1'])->name('validasi1.simpan');
        Route::get('/validasi1/data', [KajurController::class, 'getDataValidasiTahap1'])->name('validasi1.data');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');
        Route::get('/kajur/preview/{id}', [KajurController::class, 'previewPdf'])->name('kajur.preview.pdf');
    });
});

  


Route::middleware(['auth', 'authorize:DKT'])->group(function () {

    // Dashboard Direktur
    Route::get('/dashboard/direktur', [DirekturController::class, 'dashboard'])->name('direktur.dashboard');

    // Halaman utama Dokumen Final + daftar finalisasi
    Route::get('/direktur/finalisasi', [DirekturController::class, 'showDokumenFinal'])->name('direktur.finalisasi.index');

    // Saat klik ID finalisasi, tampilkan preview PDF
    Route::get('/direktur/finalisasi/{idFinalisasi}/preview', [DirekturController::class, 'previewFinalisasiEmbed'])->name('direktur.finalisasi.preview');
    Route::get('/direktur/preview/{id}', [DirekturController::class, 'previewPdf'])->name('direktur.preview');

    // Generate PDF Finalisasi (digunakan di <iframe>)
    Route::get('/direktur/finalisasi/{idFinalisasi}/pdf', [DirekturController::class, 'previewFinalisasiPdf'])->name('direktur.finalisasi.pdf');
    // Group route untuk kriteria
    Route::prefix('kriteria')->group(function () {
        Route::get('/', [DirekturController::class, 'index'])->name('direktur.kriteria.index');
        Route::get('/{id}/detail', [DirekturController::class, 'show'])->name('direktur.kriteria.show');
        Route::post('/{id}/komentar', [DirekturController::class, 'komentar'])->name('direktur.kriteria.komentar');
        Route::post('/{id}/validasi', [DirekturController::class, 'validasi'])->name('direktur.kriteria.validasi');
        Route::view('/validasi2', 'validasi.validasi2')->name('validasi2');
        Route::post('/validasi2/simpan', [DirekturController::class, 'simpanValidasiTahap2'])->name('validasi2.simpan');
        Route::get('/validasi2/data', [DirekturController::class, 'getDataValidasiTahap2'])->name('validasi2.data');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/login1', function () { return view('layouts.login1'); })->name('layouts.login1');
        

        // Preview finalisasi JSON (data lengkap per id_finalisasi)
        Route::get('/finalisasi/preview/{idFinalisasi}', [DirekturController::class, 'previewFinalisasi'])
            ->name('direktur.finalisasi.preview');

        // Halaman dokumen final
        Route::get('/dokumenfinal', [DirekturController::class, 'showDokumenFinal'])->name('direktur.dokumenfinal');
    });







Route::prefix('finalisasi')->group(function () {
    Route::get('/', [DokumenFinalController::class, 'index'])->name('DokumenFinal.index');
    Route::get('/{idFinalisasi}', [DokumenFinalController::class, 'show'])->name('DokumenFinal.show');
    Route::post('/{idFinalisasi}/merge', [DokumenFinalController::class, 'mergePdf'])->name('DokumenFinal.merge');
});










Route::post('/logout', function () {
    return redirect('/login'); // Arahkan ke halaman login setelah logout
})->name('logout');
}); 