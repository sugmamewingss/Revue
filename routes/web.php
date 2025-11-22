<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// User Routes (Authenticated)
Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Items Management
    Route::get('/items', [AdminController::class, 'items'])->name('admin.items');
    Route::get('/items/create', [AdminController::class, 'createItem'])->name('admin.items.create');
    Route::post('/items', [AdminController::class, 'storeItem'])->name('admin.items.store');
    Route::get('/items/{id}/edit', [AdminController::class, 'editItem'])->name('admin.items.edit');
    Route::put('/items/{id}', [AdminController::class, 'updateItem'])->name('admin.items.update');
    Route::delete('/items/{id}', [AdminController::class, 'deleteItem'])->name('admin.items.delete');
    
    // Genres Management
    Route::get('/genres', [AdminController::class, 'genres'])->name('admin.genres');
    Route::post('/genres', [AdminController::class, 'storeGenre'])->name('admin.genres.store');
    Route::delete('/genres/{id}', [AdminController::class, 'deleteGenre'])->name('admin.genres.delete');
    
    // Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});