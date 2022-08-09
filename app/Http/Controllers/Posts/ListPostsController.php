<?php

namespace App\Http\Controllers\Posts;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ListPostsController extends Controller
{
    public function __invoke() : View
    {
        return view('posts.index');
    }
}
