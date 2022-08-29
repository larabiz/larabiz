<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DestroyCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Comment $comment) : RedirectResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('status', 'Le commentaire a bien été supprimé.');
    }
}
