<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ShowPostController extends Controller
{
    public function __invoke(?User $user, string $randomId, ?string $slug = null) : View|RedirectResponse
    {
        $post = Post::query();

        if (config('app.master_email') === $user?->email) {
            $post = $post->withoutGlobalScope('published');
        }

        $post = $post
            ->whereRandomId($randomId)
            ->firstOrFail();

        if ($slug !== $post->slug) {
            return to_route('posts.show', [$randomId, $post->slug], 301);
        }

        return view('posts.show')->with([
            'comments' => $post->comments()->simplePaginate(),
            'post' => $post,
            'others' => Post::query()
                ->whereNotIn('random_id', [$randomId])
                ->inRandomOrder()
                ->latest()
                ->limit(6)
                ->get(),
            'subscribed' => $user?->subscribedTo($post),
        ]);
    }
}
