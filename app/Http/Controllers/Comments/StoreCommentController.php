<?php

namespace App\Http\Controllers\Comments;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCommentRequest;

class StoreCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(StoreCommentRequest $request, Post $post) : RedirectResponse
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        if ($request->boolean('subscribe')) {
            $post->subscriptions()->firstOrCreate(['user_id' => auth()->id()]);
        }

        return back()->with('status', 'Votre commentaire a bien été posté.');
    }
}
