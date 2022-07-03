<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ShowPostController extends Controller
{
    public function __invoke() : View
    {
        return view('posts.show');
    }
}
