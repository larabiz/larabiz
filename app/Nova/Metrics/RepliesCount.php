<?php

namespace App\Nova\Metrics;

use App\Models\Reply;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Http\Requests\NovaRequest;

class RepliesCount extends Value
{
    public function calculate(NovaRequest $request) : ValueResult
    {
        return $this->count($request, Reply::class);
    }
}
