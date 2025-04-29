<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/template', function () {
    return view('layouts.template');
});

Route::post('/logout', function () {
    Auth::logout(); // Melakukan proses logout
    return redirect('/login'); // Arahkan ke halaman login setelah logout
})->name('logout');
