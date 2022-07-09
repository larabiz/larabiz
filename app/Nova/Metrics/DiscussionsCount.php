<?php

namespace App\Nova\Metrics;

use App\Models\Discussion;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Http\Requests\NovaRequest;

class DiscussionsCount extends Value
{
    public function calculate(NovaRequest $request) : ValueResult
    {
        return $this->count($request, Discussion::class);
    }
}
