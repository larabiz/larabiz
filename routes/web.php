<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchPostsController;
use App\Http\Controllers\ShowPreviewController;
use App\Http\Controllers\Posts\ShowPostController;
use App\Http\Controllers\EditUserProfileController;
use App\Http\Controllers\Posts\ListPostsController;
use App\Http\Controllers\Comments\StoreCommentController;
use App\Http\Controllers\Comments\DestroyCommentController;
use App\Http\Controllers\Subscribers\StoreSubscriberController;
use App\Http\Controllers\Subscribers\ConfirmSubscriberController;
use App\Http\Controllers\Subscriptions\SubscribeToPostController;
use App\Http\Controllers\Subscriptions\UnsubscribeFromPostController;

Route::get('/', HomeController::class)->name('home');

Route::post('/subscribers', StoreSubscriberController::class)->name('subscribers.store');
Route::get('/confirm-subscriber/{subscriber:email}', ConfirmSubscriberController::class)->name('confirm-subscriber');

Route::get('/blog', ListPostsController::class)->name('posts.index');
Route::get('/blog/search', SearchPostsController::class)->name('search-posts');
Route::post('/blog/{post:random_id}/subscribe', SubscribeToPostController::class)->name('subscribe-to-post');
Route::post('/blog/{post:random_id}/unsubscribe', UnsubscribeFromPostController::class)->name('unsubscribe-from-post');
Route::get('/blog/{randomId}/{slug?}', ShowPostController::class)->name('posts.show');
Route::get('/preview/{post:random_id}', ShowPreviewController::class)->name('preview');

Route::post('/posts/{post:random_id}/comments', StoreCommentController::class)->name('comments.store');
Route::delete('/comments/{comment:random_id}', DestroyCommentController::class)->name('comments.destroy');

Route::get('/user/profile', EditUserProfileController::class)->name('user-profile');
