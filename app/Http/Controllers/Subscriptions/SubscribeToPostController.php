<?php

namespace App\Http\Controllers\Subscriptions;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SubscribeToPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Post $post) : RedirectResponse
    {
        $post->subscriptions()->firstOrCreate(['user_id' => auth()->id()]);

        return back()->with('status', 'Vous receverez désormais une notification pour chaque nouveau commentaire sur cet article.');
    }
}
