<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ShowPostController extends Controller
{
    public function __invoke(string $randomId, ?string $slug = null) : View|RedirectResponse
    {
        $post = Post::query()
            ->whereRandomId($randomId)
            ->firstOrFail();

        if ($slug !== $post->slug) {
            return to_route('posts.show', [$randomId, $post->slug], 301);
        }

        return view('posts.show')->with([
            'post' => $post,
            'others' => Post::query()
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->with('media')
                ->whereNotIn('random_id', [$randomId])
                ->latest()
                ->limit(6)
                ->get(),
        ]);
    }
}
