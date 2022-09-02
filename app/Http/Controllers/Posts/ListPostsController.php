<?php

namespace App\Http\Controllers\Posts;

use App\Contracts\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ListPostsController extends Controller
{
    public function __invoke(PostRepositoryInterface $postRepository) : View
    {
        return view('posts.index', [
            'posts' => $postRepository->all(),
        ]);
    }
}
