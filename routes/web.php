<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchPostsController;
use App\Http\Controllers\ShowPreviewController;
use App\Http\Controllers\Posts\ShowPostController;
use App\Http\Controllers\EditUserProfileController;
use App\Http\Controllers\Posts\ListPostsController;
use App\Http\Controllers\Subscribers\StoreSubscriberController;
use App\Http\Controllers\Subscribers\ConfirmSubscriberController;

Route::get('/', HomeController::class)->name('home');

Route::get('/blog', ListPostsController::class)->name('posts.index');
Route::get('/blog/search', SearchPostsController::class)->name('search-posts');
Route::get('/blog/{randomId}/{slug?}', ShowPostController::class)->name('posts.show');
Route::get('/preview/{post:random_id}', ShowPreviewController::class)->name('preview');

Route::post('/subscribers', StoreSubscriberController::class)->name('subscribers.store');
Route::get('/confirm-subscriber/{subscriber:email}', ConfirmSubscriberController::class)->name('confirm-subscriber');

Route::get('/user/profile', EditUserProfileController::class)->name('user-profile');
