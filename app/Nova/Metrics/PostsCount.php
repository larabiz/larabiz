<?php

namespace App\Nova\Metrics;

use App\Models\Post;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Http\Requests\NovaRequest;

class PostsCount extends Value
{
    public function calculate(NovaRequest $request) : ValueResult
    {
        return $this->count($request, Post::class);
    }
}
