<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Posts\ShowPostController;
use App\Http\Controllers\Posts\ListPostsController;
use App\Http\Controllers\Replies\StoreReplyController;
use App\Http\Controllers\Threads\ShowThreadController;
use App\Http\Controllers\Threads\ListThreadsController;
use App\Http\Controllers\Threads\StoreThreadController;
use App\Http\Controllers\Threads\CreateThreadController;
use App\Http\Controllers\User\EditUserProfileController;
use App\Http\Controllers\Comments\StoreCommentController;
use App\Http\Controllers\User\EditUserPasswordController;
use App\Http\Controllers\Comments\DestroyCommentController;
use App\Http\Controllers\Previews\ShowPostPreviewController;
use App\Http\Controllers\User\ManageSubscriptionsController;
use App\Http\Controllers\Subscribers\StoreSubscriberController;
use App\Http\Controllers\Subscribers\ConfirmSubscriberController;
use App\Http\Controllers\Subscriptions\SubscribeToPostController;
use App\Http\Controllers\Subscriptions\UnsubscribeFromPostController;

// Pages
Route::get('/', HomeController::class)->name('home');

// Subscribers
Route::post('/subscribers', StoreSubscriberController::class)->name('subscribers.store');
Route::get('/confirm-subscriber/{subscriber:email}', ConfirmSubscriberController::class)
    ->name('confirm-subscriber');

// Blog
Route::get('/blog', ListPostsController::class)->name('posts.index');

// Comments
Route::post('/blog/{post:random_id}/comments', StoreCommentController::class)->name('posts.comments.store');
Route::delete('/comments/{comment:random_id}', DestroyCommentController::class)->name('comments.destroy');

// Previews
Route::get('/previews/posts/{post:random_id}', ShowPostPreviewController::class)->name('previews.post');

// Subscriptions
Route::post('/blog/{post:random_id}/subscribe', SubscribeToPostController::class)->name('subscribe-to-post');
Route::post('/blog/{post:random_id}/unsubscribe', UnsubscribeFromPostController::class)->name('unsubscribe-from-post');

// User
Route::get('/user/profile', EditUserProfileController::class)->name('user-profile');
Route::get('/user/password', EditUserPasswordController::class)->name('user-password');
Route::get('/user/subscriptions', ManageSubscriptionsController::class)->name('user-subscriptions');

// Forum
Route::get('/forum', ListThreadsController::class)->name('threads.index');
Route::get('/forum/create', CreateThreadController::class)->name('threads.create');
Route::post('/forum', StoreThreadController::class)->name('threads.store');
Route::get('/forum/{randomId}/{slug}', ShowThreadController::class)->name('threads.show');
Route::post('/forum/{thread:random_id}/replies', StoreReplyController::class)->name('threads.replies.store');

Route::feeds();

Route::redirect('/blog/{randomId}/{slug?}', '/{slug}', 301);
Route::get('/{post:slug}', ShowPostController::class)->name('posts.show');
