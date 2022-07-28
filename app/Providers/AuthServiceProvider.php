<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Policies\DatabaseNotificationPolicy;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    protected $policies = [
        DatabaseNotification::class => DatabaseNotificationPolicy::class,
    ];

    public function boot() : void
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ('benjamincrozat@me.com' === $user->email) {
                return true;
            }
        });
    }
}
