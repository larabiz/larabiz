<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\Commented;
use App\Notifications\NewComment;
use App\Actions\ExperienceGains\CreateNewExperienceGain;

class CommentedListener
{
    public function handle(Commented $event) : void
    {
        (new CreateNewExperienceGain)->create(
            30, 'Pour avoir posté un commentaire. Merci de faire vivre le site !', $event->comment->user
        );

        if ($event->comment->user->isNot($master = User::master()->first())) {
            $master->notify(new NewComment($event->comment));
        }
    }
}
