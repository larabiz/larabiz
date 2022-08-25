<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class ShowPreviewController extends Controller
{
    public function __invoke(Post $post) : View
    {
        return view('preview', compact('post'));
    }
}
