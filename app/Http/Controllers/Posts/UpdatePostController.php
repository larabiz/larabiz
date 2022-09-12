<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;

class UpdatePostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->collect()->except('status')->toArray());

        if ($request->status !== $post->status) {
            $post->setStatus($request->status);
        }

        return back()->with('status', 'Votre article a bien été modifié.');
    }
}
