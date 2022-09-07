<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    protected function gate() : void
    {
        Gate::define('viewHorizon', function ($user) {
            return in_array($user->email, [
                config('app.master_email'),
            ]);
        });
    }
}
