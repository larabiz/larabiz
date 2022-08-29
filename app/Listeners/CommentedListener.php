<?php

namespace App\Listeners;

use App\Events\Commented;
use App\Models\Subscription;
use App\Notifications\Users\Comments\NewComment;

class CommentedListener
{
    public function handle(Commented $event) : void
    {
        $event->comment->post->subscriptions->each(function (Subscription $subscription) use ($event) {
            if ($subscription->user->isNot($event->comment->user)) {
                $subscription->user->notify(new NewComment($event->comment));
            }
        });
    }
}
