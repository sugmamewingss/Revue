<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;

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

use App\Http\Controllers\CatalogController; 
// ... (Pastikan ini ada di bagian atas file)

// =========================
// HALAMAN SETELAH LOGIN (HOMEPAGE)
// =========================

// GANTI rute yang mungkin menggunakan closure function() {} lama
// PASTIKAN SEMUA AKSES KE HOMEPAGE MENGGUNAKAN CONTROLLER
Route::get('/homepage', [CatalogController::class, 'index'])
    ->middleware('auth')
    ->name('homepage');

    // Asumsi Anda menggunakan CatalogController untuk homepage
Route::get('/', [CatalogController::class, 'index'])->name('homepage');

// === ROUTE BARU UNTUK HALAMAN BOOKS ===
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

     Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
// Tambahkan route lain di sini (login, logout, admin, dll.)
// ...
// --- GENRE ---
    // 1. Menampilkan Daftar Semua Genre (genre.blade.php)
    Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');

    // 2. Menampilkan Item yang Difilter oleh ID Genre (Setelah Card Genre Diklik)
    // Rute ini menerima ID dari URL, misalnya /genre/1
    Route::get('/genre/{genreId}/items', [GenreController::class, 'showItemsByGenre'])
        ->name('genre.items');
