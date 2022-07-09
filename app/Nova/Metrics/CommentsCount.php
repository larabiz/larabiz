<?php

namespace App\Nova\Metrics;

use App\Models\Comment;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Http\Requests\NovaRequest;

class CommentsCount extends Value
{
    public function calculate(NovaRequest $request) : ValueResult
    {
        return $this->count($request, Comment::class);
    }
}
