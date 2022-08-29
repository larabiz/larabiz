<?php

namespace App\Http\Controllers\Comments;

use App\Models\Post;
use App\Events\Commented;
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
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        if ($request->boolean('subscribe')) {
            $post->subscriptions()->firstOrCreate(['user_id' => auth()->id()]);
        } else {
            $post->subscriptions()->where([
                ['user_id', auth()->id()],
                ['subscribable_type', $post->getMorphClass()],
                ['subscribable_id', $post->id],
            ])->delete();
        }

        event(new Commented($comment));

        return back()->with('status', 'Votre commentaire a bien été posté.');
    }
}
