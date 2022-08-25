<?php

namespace App\Nova\Metrics;

use App\Models\User;
use App\Models\Subscriber;
use Laravel\Nova\Http\Requests\NovaRequest;

class EmailsCount extends Value
{
    public function calculate(NovaRequest $request)
    {
        $query = User::select('email')
            ->whereNotNull('email_verified_at');

        $count = Subscriber::select('email')
            ->whereNotNull('confirmed_at')
            ->union($query)
            ->count();

        return $this->result($count);
    }

    public function ranges() : array
    {
        return [];
    }
}
