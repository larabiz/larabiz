<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class ListPostsController extends Controller
{
    public function __invoke(Request $request) : View
    {
        return view('posts.index');
    }
}
