<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\View\View;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function show(Comment $comment) : View
    {
        return view('comments.show')->with(compact('comment'));
    }
}
