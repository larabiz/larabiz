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

        // Notify the master if it's not a comment from the master himself.
        if ('benjamincrozat@me.com' !== $event->comment->user->email) {
            User::master()->first()?->notify(new NewComment($event->comment));
        }
    }
}
