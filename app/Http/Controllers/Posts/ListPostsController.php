<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ListPostsController extends Controller
{
    public function __invoke() : View
    {
        return view('posts.index')->with([
            'posts' => Post::query()
                ->withUsername()
                ->latest()
                ->get(),
        ]);
    }
}
