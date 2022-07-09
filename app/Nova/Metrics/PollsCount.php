<?php

namespace App\Nova\Metrics;

use App\Models\Poll;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Http\Requests\NovaRequest;

class PollsCount extends Value
{
    public function calculate(NovaRequest $request) : ValueResult
    {
        return $this->count($request, Poll::class);
    }
}
