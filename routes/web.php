<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('items', ItemController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('genres', GenreController::class);

