<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListPostsController extends Controller
{
    public function __invoke(Request $request) : View
    {
        $posts = $request->q
            ? Post::search($request->q)
            : Post::latest();

        return view('posts.index')->with([
            'posts' => $posts->simplePaginate(10),
            'q' => $request->q,
        ]);
    }
}
