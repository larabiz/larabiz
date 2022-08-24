<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\Users\NewUser;
use Illuminate\Auth\Events\Registered;

class RegisteredListener
{
    public function handle(Registered $event) : void
    {
        User::master()->first()?->notify(
            new NewUser($event->user)
        );
    }
}
