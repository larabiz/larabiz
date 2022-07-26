<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ShowPostController extends Controller
{
    public function __invoke(string $randomId, ?string $slug = null) : View|RedirectResponse
    {
        $post = Post::whereRandomId($randomId)->firstOrFail();

        if ($slug !== $post->slug) {
            return to_route('posts.show', [$randomId, $post->slug]);
        }

        return view('posts.show')->with([
            'post' => $post,
            'others' => Post::latest()
                ->whereNotIn('random_id', [$randomId])
                ->limit(6)
                ->get(),
        ]);
    }
}
