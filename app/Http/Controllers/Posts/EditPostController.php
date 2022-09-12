<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class EditPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Post $post) : View
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }
}
