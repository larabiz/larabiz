<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ShowPostController extends Controller
{
    public function __invoke(string $id, ?string $slug = null) : View|RedirectResponse
    {
        $post = Post::find($id);

        if ($slug !== $post->slug) {
            return to_route('posts.show', [$id, $post->slug]);
        }

        return view('posts.show')->with([
            'post' => $post,
            'others' => Post::latest()
                ->whereNotIn('id', [$id])
                ->limit(6)
                ->get(),
        ]);
    }
}
