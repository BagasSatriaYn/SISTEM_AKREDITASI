<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KriteriaSatuController;
use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\Auth\DashboardController;

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
 
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
Route::middleware(['auth'])->group(function() { //artinya semua route di dalam group ini harus login dulu
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




// Route::prefix('kriteria')->group(function() {
//     Route::get('A1', [KriteriaController::class, 'show']);
//     Route::get('A2', [KriteriaController::class, 'show']);
//     Route::get('A3', [KriteriaController::class, 'show']);
//     // Tambahkan route untuk A4 hingga A9
// });
//  Route::middleware(['authorize:A2'])->prefix('kriteria2')->group(function (){
//     Route::get('/index/anggota', [WelcomeController::class, 'index']); // menampilkan halaman awal user
//     Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
//     Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
//     Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
//     Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
//     Route::post('/ajax', [UserController::class, 'store_ajax']);      // Menyimpan data user baru Ajax
//     Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
//     Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
//     Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
//     Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
//     Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
//     Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
//     Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
//     Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
//     Route::get('/import', [UserController::class, 'import']);
//     Route::post('/import_ajax', [UserController::class, 'import_ajax']);
//     Route::get('/export_excel', [UserController::class, 'export_excel']); // export excel
//     Route::get('/export_pdf', [UserController::class, 'export_pdf']); // export pdf
//     Route::get('/profile', [UserController::class, 'profile_page']);
//     Route::post('/update_picture', [UserController::class, 'update_picture']);
    
// });

//  Route::middleware(['authorize:kajur'])->prefix('kajur')->group(function (){
//     Route::get('/index/kajur', [WelcomeController::class, 'index']); // menampilkan halaman awal user
//     Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
//     Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
//     Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
//     Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
//     Route::post('/ajax', [UserController::class, 'store_ajax']);      // Menyimpan data user baru Ajax
//     Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
//     Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
//     Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
//     Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
//     Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
//     Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
//     Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
//     Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
//     Route::get('/import', [UserController::class, 'import']);
//     Route::post('/import_ajax', [UserController::class, 'import_ajax']);
//     Route::get('/export_excel', [UserController::class, 'export_excel']); // export excel
//     Route::get('/export_pdf', [UserController::class, 'export_pdf']); // export pdf
//     Route::get('/profile', [UserController::class, 'profile_page']);
//     Route::post('/update_picture', [UserController::class, 'update_picture']);
    
// });







Route::post('/logout', function () {
    return redirect('/login'); // Arahkan ke halaman login setelah logout
})->name('logout');

