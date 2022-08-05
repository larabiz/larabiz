<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LoginListener
{
    public function handle(Login $event) : void
    {
        $event->user->update([
            'last_login_at' => now(),
        ]);
    }
}
