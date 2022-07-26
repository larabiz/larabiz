<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use App\Notifications\NewConfirmedUser;

class VerifiedListener
{
    public function handle(Verified $event) : void
    {
        User::master()->first()?->notify(
            new NewConfirmedUser($event->user)
        );
    }
}
