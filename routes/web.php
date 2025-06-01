<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KriteriaSatuController;
use App\Http\Controllers\KriteriaDuaController;
use App\Http\Controllers\KriteriaTigaController;
use App\Http\Controllers\KriteriaEmpatController;
use App\Http\Controllers\KriteriaLimaController;
use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DokumenFinalController;
use App\Http\Controllers\DokumenController;



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
        
Route::middleware(['auth','authorize:A1'])->prefix('kriteria1')->group(function () {
    Route::get('/preview/{id}', [KriteriaSatuController::class, 'preview'])->name('kriteria1.preview');
    Route::get('/kriteria/{id}/preview', [KriteriaSatuController::class, 'preview']);
    Route::get('/{id}/preview/json', [KriteriaSatuController::class, 'getPreviewData'])->name('kriteria1.preview.data');



    Route::get('/index/anggota', [WelcomeController::class, 'index']);
    Route::get('/index', [KriteriaSatuController::class, 'index'])->name('kriteria1.index'); 
    Route::post('/list', [KriteriaSatuController::class, 'list'])->name('kriteria1.list');

    Route::get('/input', [KriteriaSatuController::class, 'create']);    
    Route::post('/store', [KriteriaSatuController::class, 'store']);
    Route::post('/upload', [KriteriaSatuController::class, 'uploadImage'])->name('image.upload');

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
    Route::get('/dashboard/direktur', [DirekturController::class, 'dashboard'])->name('direktur.dashboard');
    Route::prefix('kriteria')->group(function () {
        Route::get('/', [DirekturController::class, 'index'])->name('direktur.kriteria.index');
        Route::get('/{id}/detail', [DirekturController::class, 'show'])->name('direktur.kriteria.show');
        Route::post('/{id}/komentar', [DirekturController::class, 'komentar'])->name('direktur.kriteria.komentar');
        Route::post('/{id}/validasi', [DirekturController::class, 'validasi'])->name('direktur.kriteria.validasi');
        Route::view('/validasi2', 'validasi.validasi2')->name('validasi2'); 
        Route::post('/validasi2/simpan', [DirekturController::class, 'simpanValidasiTahap2'])->name('validasi2.simpan');
        Route::get('/validasi2/data', [DirekturController::class, 'getDataValidasiTahap2'])->name('validasi2.data');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/login1', function () {return view('layouts.login1');})->name('layouts.login1');
        Route::get('/direktur/preview/{id}', [DirekturController::class, 'previewPdf'])->name('direktur.preview.pdf');
    });
});

Route::get('/dokumen-final', [DokumenFinalController::class, 'index'])->name('dokumen-final');
Route::get('/dokumen-final/generate/{id}', [DokumenFinalController::class, 'generatePdf'])->name('dokumen.generate');
Route::get('/generate-pdf/{id}', [\App\Http\Controllers\DokumenFinalController::class, 'generatePdf']);



// Tambahkan di routes/web.php
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/dokumen-final', [DokumenController::class, 'show'])->name('dokumen-final');
Route::resource('dokumen-final', DokumenFinalController::class);


Route::get('/validasi/validasi1', function () {
    return view('validasi.validasi1');
});

Route::get('/validasi/validasi2', function () {
    return view('validasi.validasi2');
});








Route::post('/logout', function () {
    return redirect('/login'); // Arahkan ke halaman login setelah logout
})->name('logout');
