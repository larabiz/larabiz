<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LoginListener
{
    public function handle(Login $event) : void
    {
        /** @var \App\Models\User */
        $user = $event->user;

        $user->update([
            'last_login_at' => now(),
        ]);
    }
}
