<?php

namespace App\Contracts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function find(string $id): Post;

    public function all(): Collection;
    
    public function latest(?int $limit = 4): Collection;

    public function random(string $except, ?int $limit = 6): Collection;
}
