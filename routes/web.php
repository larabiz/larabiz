<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowPostController;
use App\Http\Controllers\ListPostsController;

Route::view('/', 'home')->name('home');

Route::get('/blog', ListPostsController::class)->name('posts.index');
Route::get('/blog/show', ShowPostController::class)->name('posts.show');

Route::get('/test', function () {
    dispatch(fn () => sleep(3))->afterResponse();

    return 'Hello, World!';
});
