<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ShowPostController extends Controller
{
    public function __invoke(Request $request, string $randomId, ?string $slug = null) : View|RedirectResponse
    {
        $post = Post::query();

        if ('benjamincrozat@me.com' === $request->user()?->email) {
            $post = $post->withoutGlobalScope('published');
        }

        $post = $post
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
                ->whereNotIn('random_id', [$randomId])
                ->inRandomOrder()
                ->latest()
                ->limit(6)
                ->get(),
            'subscribed' => auth()->user()?->subscribedTo($post),
        ]);
    }
}
