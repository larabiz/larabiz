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

        $request->boolean('subscribe')
            ? $request->user()->subscribeTo($post)
            : $request->user()->unsubscribeFrom($post);

        event(new Commented($comment));

        $page = $post->comments()->paginate()->lastPage();

        return to_route('posts.show', [$post->random_id, $post->slug] + compact('page'))
            ->withFragment('#comments')
            ->with('status', 'Votre commentaire a bien été posté.');
    }
}
