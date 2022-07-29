<?php

namespace App\Actions\ExperienceGains;

use App\Models\User;
use App\Notifications\NewExperienceGain;

class CreateNewExperienceGain
{
    public function create(int $points, string $message, User $user, bool $notify = false) : void
    {
        $user->experience_gains()->create(compact('points', 'message'));

        if ($notify) {
            $user->notify(new NewExperienceGain(
                $points, $message
            ));
        }
    }
}
