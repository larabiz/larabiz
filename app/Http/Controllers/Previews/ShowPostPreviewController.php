<?php

namespace App\Http\Controllers\Previews;

use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowPostPreviewController extends Controller
{
    public function __construct()
    {
        if (app()->isProduction()) {
            $this->middleware('signed');
        }
    }

    public function __invoke(Post $post) : View
    {
        return view('previews.post', compact('post'));
    }
}
