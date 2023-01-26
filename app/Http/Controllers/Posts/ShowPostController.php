<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ShowPostController extends Controller
{
    public function __invoke(?User $user, Post $post) : View|RedirectResponse
    {
        return view('posts.show')->with([
            'comments' => $post->comments()->simplePaginate(),
            'post' => $post,
            'others' => Post::query()
                ->whereNotIn('id', [$post->id])
                ->inRandomOrder()
                ->latest()
                ->limit(6)
                ->get(),
            'subscribed' => $user?->subscribedTo($post),
        ]);
    }
}
