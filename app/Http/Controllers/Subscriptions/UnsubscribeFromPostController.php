<?php

namespace App\Http\Controllers\Subscriptions;

use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Honeypot\ProtectAgainstSpam;

class UnsubscribeFromPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(ProtectAgainstSpam::class);
    }

    public function __invoke(User $user, Post $post) : RedirectResponse
    {
        $user->unsubscribeFrom($post);

        return back()->with('status', 'Vous ne recevrez plus de notifications en rapport avec cet article.');
    }
}
