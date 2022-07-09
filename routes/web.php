<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowPostController;
use App\Http\Controllers\ListPostsController;
use App\Http\Controllers\StoreSubscriberController;
use App\Http\Controllers\ConfirmSubscriberController;

Route::view('/', 'home')->name('home');

Route::get('/', HomeController::class)->name('home');
Route::get('/blog', ListPostsController::class)->name('posts.index');
Route::get('/blog/{id}/{slug?}', ShowPostController::class)->name('posts.show');

Route::post('/subscribers', StoreSubscriberController::class)->name('subscribers.store');
Route::get('/confirm-subscriber/{subscriber:email}', ConfirmSubscriberController::class)->name('confirm-subscriber');
