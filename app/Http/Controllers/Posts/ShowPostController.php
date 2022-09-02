<?php

namespace App\Http\Controllers\Posts;

use App\Contracts\PostRepositoryInterface;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ShowPostController extends Controller
{
    public function __invoke(PostRepositoryInterface $postRepository, string $randomId, ?string $slug = null) : View|RedirectResponse
    {
        $post = $postRepository->find(id: $randomId);

        if ($slug !== $post->slug) {
            return to_route('posts.show', [$randomId, $post->slug], 301);
        }

        return view('posts.show', [
            'post' => $post,
            'others' => $postRepository->random(except: $randomId),
            'subscribed' => auth()->user()?->subscribedTo($post),
        ]);
    }
}
