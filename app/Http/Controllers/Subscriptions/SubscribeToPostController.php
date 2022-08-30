<?php

namespace App\Http\Controllers\Subscriptions;

use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SubscribeToPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(User $user, Post $post) : RedirectResponse
    {
        $user->subscribeTo($post);

        return back()->with('status', 'Vous receverez désormais une notification pour chaque nouveau commentaire sur cet article.');
    }
}
