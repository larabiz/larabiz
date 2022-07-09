<?php

namespace App\Nova\Metrics;

use App\Models\Subscriber;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Http\Requests\NovaRequest;

class SubscribersCount extends Value
{
    public function calculate(NovaRequest $request) : ValueResult
    {
        return $this->count($request, Subscriber::class);
    }
}
