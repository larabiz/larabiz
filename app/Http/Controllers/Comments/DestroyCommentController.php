<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Honeypot\ProtectAgainstSpam;

class DestroyCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(ProtectAgainstSpam::class);
    }

    public function __invoke(Comment $comment) : RedirectResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('status', 'Le commentaire a bien été supprimé.');
    }
}
