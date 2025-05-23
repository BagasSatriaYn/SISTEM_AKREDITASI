<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\Anggota\AnggotaController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\Dashboard1Controller;


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
Route::pattern('id', '[0-9]+'); //artinya ketika parameter {id}, maka harus berupa angka
 
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

Route::get('/Direktur/dashboard', [DashboardController::class, 'index'])->name('dashboarddirektur');
Route::get('/Kajur/dashboard', [Dashboard1Controller::class, 'index'])->name('dashboardkajur');
 
Route::middleware(['auth'])->group(function() { //artinya semua route di dalam group ini harus login dulu
 });




    Route::get('Anggota/dashboard', [WelcomeController::class, 'index']); // menampilkan halaman awal user
    Route::get('/index', [KriteriaController::class, 'index'])->name('kriteria1.index'); // Menampilkan semua kriteria
    Route::get('/input', [KriteriaController::class, 'input'])->name('kriteria1.input');
    Route::post('store', [KriteriaController::class, 'store'])->name('kriteria1.store'); // Menyimpan data kriteria baru;
    Route::get('/{id}', [KriteriaController::class, 'show']); // Menampilkan detail kriteria
    Route::put('/{id}', [KriteriaController::class, 'update']); // Update kriteria
    Route::delete('/{id}', [KriteriaController::class, 'destroy']); // Menghapus kriteria
    

Route::prefix('kriteria')->group(function() {
    Route::get('A1', [KriteriaController::class, 'show']);
    Route::get('A2', [KriteriaController::class, 'show']);
    Route::get('A3', [KriteriaController::class, 'show']);
    // Tambahkan route untuk A4 hingga A9
});
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

