<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class ListPostsController extends Controller
{
    public function __invoke() : View
    {
        return view('posts.index')->with([
            'posts' => Post::latest()->simplePaginate(10),
        ]);
    }
}
