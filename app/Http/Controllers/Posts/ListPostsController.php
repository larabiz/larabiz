<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ListPostsController extends Controller
{
    public function __invoke() : View
    {
        return view('posts.index')->with([
            'posts' => Post::query()
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->latest()
                ->get(),
        ]);
    }
}
