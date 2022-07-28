<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Auth\Events\Registered;
use App\Actions\ExperienceGains\CreateNewExperienceGain;

class RegisteredListener
{
    public function handle(Registered $event) : void
    {
        (new CreateNewExperienceGain)->create(
            100, 'Merci de vous être inscrit !', $event->user, notify: true
        );

        User::master()->first()?->notify(
            new NewUser($event->user)
        );
    }
}
