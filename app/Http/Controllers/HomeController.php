<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke() : View
    {
        return view('home')->with([
            'latest' => Post::latest()->limit(6)->get(),
        ]);
    }
}
