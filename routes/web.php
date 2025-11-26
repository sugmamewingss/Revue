<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminController; 
// WAJIB: Import Class Middleware yang akan digunakan secara langsung
use App\Http\Middleware\OnlyAdmin; 

// =========================
// AUTHENTICATION (Login, Register, Logout)
// =========================
// Route utama: Mengarah ke Homepage jika sudah login, ke Welcome jika belum
Route::get('/', [CatalogController::class, 'index'])->name('homepage');

    // User Pertama kali landing site:
    Route::get('/user', [ProfileController::class, 'public'])
    ->middleware('auth')
    ->name('user.page');

    // Login GET dan POST
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Sign Up GET dan POST
    Route::get('/signup', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
    Route::post('/signup', [AuthController::class, 'register'])->name('register.post'); // Solusi Error MethodNotAllowed

    // Rute yang butuh otentikasi
    Route::middleware('auth')->group(function () {  
    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Profil User dan My List
    Route::get('/user/profile', [ProfileController::class, 'showProfile'])
    ->middleware('auth')
    ->name('user.profile');

    
    Route::get('/user/mylist', [ProfileController::class, 'mylist'])
    ->middleware('auth')->name('user.mylist');

    
    Route::get('/item/{itemId}', [CatalogController::class, 'showItemDetail'])->name('item.detail');

    // ===============================================
    // ADMIN ROUTES (MENGGUNAKAN FQCN BUKAN ALIAS)
    // ===============================================
    // MIDDELWARE KINI MENGGUNAKAN NAMA CLASS LANGSUNG (OnlyAdmin::class)
    Route::middleware(OnlyAdmin::class)->prefix('admin')->group(function () { 
        
        // --- GENRE CRUD ---
        Route::get('/genre', [AdminController::class, 'index'])->name('admin.genre.index');
        Route::post('/genre', [AdminController::class, 'store'])->name('admin.genre.store'); 
        Route::get('/genre/{genre}/edit', [AdminController::class, 'edit'])->name('admin.genre.edit'); 
        Route::put('/genre/{genre}', [AdminController::class, 'update'])->name('admin.genre.update'); 
        Route::delete('/genre/{genre}', [AdminController::class, 'destroy'])->name('admin.genre.destroy'); 

        // --- ITEM CRUD (Kerangka Awal) ---
        Route::get('/item/create', [AdminController::class, 'createItem'])->name('admin.item.create'); 
        Route::post('/item', [AdminController::class, 'storeItem'])->name('admin.item.store'); 
    });

});

// CATALOG VIEW (PUBLIC/GUEST)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genre/{genreId}/items', [GenreController::class, 'showItemsByGenre'])->name('genre.items');