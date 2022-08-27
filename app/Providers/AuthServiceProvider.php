<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
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

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Confirmez votre adresse e-mail, humain !')
                ->greeting('Bip boop boop !')
                ->line('Inclinez-vous devant la suprématie du genre robot ! Cliquez ci-dessous afin de prouver que vous faites bien partie de la race humaine.')
                ->action('Je suis humain. Krzr… Bip !', $url);
        });
    }
}
