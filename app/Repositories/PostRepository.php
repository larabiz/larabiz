<?php

namespace App\Repositories;

use App\Contracts\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    public function find(string $id): Post
    {   
        $post = Post::query();

        if ('benjamincrozat@me.com' === auth()->user()?->email) {
            $post = $post->withoutGlobalScope('published');
        }

        $post = $post
            ->whereRandomId($id)
            ->firstOrFail();

        return $post;
    }

    public function all(): Collection
    {
        return Post::query()
            ->withUsername()
            ->latest()
            ->get();
    }

    public function latest(?int $limit = 4): Collection
    {
        return Post::query()
            ->withUsername()
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function random(string $except, ?int $limit = 6): Collection
    {
        return Post::query()
            ->withUsername()
            ->whereNotIn('random_id', [$except])
            ->inRandomOrder()
            ->latest()
            ->limit($limit)
            ->get();
    }
}
