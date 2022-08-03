<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        $this->registerPolicies();

        Auth::provider('eloquent', function ($app, array $config) {
            return new EloquentUserProvider(
                $app['hash'], $config['model']
            );
        });

        Gate::before(function ($user) {
            if ('benjamincrozat@me.com' === $user->email) {
                return true;
            }
        });
    }
}
