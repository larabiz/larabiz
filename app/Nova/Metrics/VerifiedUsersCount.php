<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;

class VerifiedUsersCount extends Value
{
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, User::verified());
    }
}
