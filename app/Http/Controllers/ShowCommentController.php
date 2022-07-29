<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\View\View;

class ShowCommentController extends Controller
{
    public function __invoke(Comment $comment) : View
    {
        return view('comments.show')->with(compact('comment'));
    }
}
