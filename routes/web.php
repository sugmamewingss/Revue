<?php

use App\Http\Controllers\AuthController;
<<<<<<< Updated upstream
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
=======
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




>>>>>>> Stashed changes
