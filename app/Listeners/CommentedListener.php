<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\Commented;
use App\Notifications\Comments\NewComment;

class CommentedListener
{
    public function handle(Commented $event) : void
    {
        // Notify master if it comes from a user.
        if ('benjamincrozat@me.com' !== $event->comment->user->email) {
            User::master()->first()?->notify(new NewComment($event->comment));
        }
    }
}
