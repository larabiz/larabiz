<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\Commented;
use App\Notifications\Users\Comments\NewComment;

class CommentedListener
{
    public function handle(Commented $event) : void
    {
        $event->comment->post->comments->map->user->each(function (User $user) use ($event) {
            if ($user->subscribedTo($event->comment->post)) {
                $user->notify(new NewComment($event->comment));
            }
        });
    }
}
