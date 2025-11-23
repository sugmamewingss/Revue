<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\AuthController;
>>>>>>> Stashed changes

// Landing page (opsional)
Route::get('/', function () {
    return view('welcome');
});
<<<<<<< Updated upstream
=======

// =========================
// SIGNUP (REGISTER)
// =========================
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
Route::post('/signup', [AuthController::class, 'register'])->name('register.post');

// =========================
// LOGIN
// =========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// =========================
// LOGOUT
// =========================
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// =========================
// HALAMAN SETELAH LOGIN
// =========================
Route::get('/homepage', function () {
    return view('homepage');
})->middleware('auth')->name('homepage');
>>>>>>> Stashed changes
