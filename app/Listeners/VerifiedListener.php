<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use App\Notifications\NewConfirmedUser;
use App\Actions\ExperienceGains\CreateNewExperienceGain;

class VerifiedListener
{
    public function handle(Verified $event) : void
    {
        (new CreateNewExperienceGain)->create(
            100, 'Pour avoir confirmé votre adresse e-mail.', $event->user, notify: true
        );

        User::master()->first()?->notify(
            new NewConfirmedUser($event->user)
        );
    }
}
