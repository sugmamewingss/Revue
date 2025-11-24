<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Landing page (opsional)
Route::get('/', function () {
    return view('welcome');
});

// =========================
// SIGNUP (REGISTER)
// =========================
// GANTI:
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');

// MENJADI:
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); // Hapus ->middleware('guest')
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register'); // Hapus ->middleware('guest')
// =========================
// LOGOUT
// =========================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// =========================
// LOGIN (Rute POST)
// =========================
// PASTIKAN BARIS INI ADA PERSIS SEPERTI INI:
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// =========================
// HALAMAN SETELAH LOGIN
// =========================
Route::get('/homepage', function () {
    return view('homepage');
})->middleware('auth')->name('homepage');

// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//     // Rute CRUD item akan diletakkan di sini
// });