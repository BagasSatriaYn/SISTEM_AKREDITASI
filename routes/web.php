<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KriteriaSatuController;
use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DokumenFinalController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProfileController;



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
 
// Auth Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show')->middleware('auth');
Route::get('/profil', [ProfileController::class, 'show'])->name('profil')->middleware('auth');
Route::post('/profil/upload', [ProfileController::class, 'upload'])->name('profile.upload')->middleware('auth');

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
    Route::get('/preview/{id}', [KriteriaSatuController::class, 'preview'])->name('preview.ppepp');

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
    });

    Route::middleware(['auth', 'authorize:KJR'])->group(function () {
    Route::get('/dashboard/kajur', [KajurController::class, 'dashboard'])->name('kajur.dashboard');
    Route::prefix('kriteria')->group(function () {
        Route::get('/', [KajurController::class, 'index'])->name('kajur.kriteria.index');
        Route::get('/{id}/detail', [KajurController::class, 'show'])->name('kajur.kriteria.show');
        Route::post('/{id}/komentar', [KajurController::class, 'komentar'])->name('kajur.kriteria.komentar');
        Route::post('/{id}/validasi', [KajurController::class, 'validasi'])->name('kajur.kriteria.validasi');
    });
});

    Route::middleware(['auth', 'authorize:DKT'])->group(function () {
Route::get('/dashboard/direktur', [DirekturController::class, 'dashboard'])->name('direktur.dashboard');


    Route::prefix('kriteria')->group(function () {
        Route::get('/', [DirekturController::class, 'index'])->name('direktur.kriteria.index');
        Route::get('/{id}/detail', [DirekturController::class, 'show'])->name('direktur.kriteria.show');
        Route::post('/{id}/komentar', [DirekturController::class, 'komentar'])->name('direktur.kriteria.komentar');
        Route::post('/{id}/validasi', [DirekturController::class, 'validasi'])->name('direktur.kriteria.validasi');
    });
});






Route::prefix('finalisasi')->group(function () {
    Route::get('/', [DokumenFinalController::class, 'index'])->name('DokumenFinal.index');
    Route::get('/{idFinalisasi}', [DokumenFinalController::class, 'show'])->name('DokumenFinal.show');
    Route::post('/{idFinalisasi}/merge', [DokumenFinalController::class, 'mergePdf'])->name('DokumenFinal.merge');
});












Route::post('/logout', function () {
    return redirect('/login'); // Arahkan ke halaman login setelah logout
})->name('logout');
