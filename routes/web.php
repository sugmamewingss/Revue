<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\HomepageController;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Controllers\UserListController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomepageController::class, 'index'])->name('homepage');

// Books & Movies
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

// Genre
// Genre
Route::get('/genre', [GenreController::class, 'index'])
    ->name('genre.index');

Route::get('/genre/{genre}', [GenreController::class, 'showItemsByGenre'])
    ->name('genre.items');


// Item Detail
Route::get('/item/{itemId}', [CatalogController::class, 'showItemDetail'])
    ->name('item.detail');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/signup', [AuthController::class, 'showRegister'])
    ->name('register')
    ->middleware('guest');

Route::post('/signup', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/user/profile', [ProfileController::class, 'showProfile'])
        ->name('user.profile');

    Route::get('/user/mylist', [ProfileController::class, 'mylist'])
        ->name('user.mylist');

    Route::post('/item/{id}/review', [CatalogController::class, 'storeReview'])
        ->name('item.review');

    Route::post('/user-list/toggle', [UserListController::class, 'toggle'])
        ->name('userlist.toggle');

    Route::delete('/my-list/{item}', [UserListController::class, 'destroy'])
        ->name('mylist.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', OnlyAdmin::class])
    ->prefix('admin')
    ->group(function () {

        // GENRE
        Route::get('/genre', [AdminController::class, 'index'])->name('admin.genre.index');
        Route::post('/genre', [AdminController::class, 'store'])->name('admin.genre.store');
        Route::get('/genre/{genre}/edit', [AdminController::class, 'edit'])->name('admin.genre.edit');
        Route::put('/genre/{genre}', [AdminController::class, 'update'])->name('admin.genre.update');
        Route::delete('/genre/{genre}', [AdminController::class, 'destroy'])->name('admin.genre.destroy');

        // ITEM
        Route::get('/item', [AdminController::class, 'indexItem'])->name('admin.item.index');
        Route::get('/item/create', [AdminController::class, 'createItem'])->name('admin.item.create');
        Route::post('/item', [AdminController::class, 'storeItem'])->name('admin.item.store');
        Route::get('/item/{id}/edit', [AdminController::class, 'editItem'])->name('admin.item.edit');
        Route::put('/item/{id}', [AdminController::class, 'updateItem'])->name('admin.item.update');
        Route::delete('/item/{id}', [AdminController::class, 'destroyItem'])->name('admin.item.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/user-list/toggle', [\App\Http\Controllers\UserListController::class, 'toggle'])
    ->name('userlist.toggle')
    ->middleware('auth');



    Route::delete('/my-list/{item}', [UserListController::class, 'destroy'])
        ->name('mylist.destroy');
});

// Route::get(uri: '/genre', [GenreController::class, 'index'])->name('genre.index');




