<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KriteriaSatuController;
use App\Http\Controllers\DetailKriteriaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route publik
Route::post('/login', [AuthController::class, 'login']);

// Route yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // Users - hanya admin yang dapat akses
    Route::middleware('authorize:admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('levels', LevelController::class);
    });
    
    // Kriteria - admin dan koordinator
    Route::middleware('authorize:admin,koordinator')->group(function () {
        Route::apiResource('kriteria', KriteriaSatuController::class);
    });
    
    // Detail Kriteria - semua pengguna bisa akses
    Route::apiResource('detail-kriteria', DetailKriteriaController::class);
});