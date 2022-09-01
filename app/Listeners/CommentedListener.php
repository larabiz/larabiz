<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\Commented;
use App\Models\Subscription;
use App\Notifications\NewComment;

class CommentedListener
{
    public function handle(Commented $event) : void
    {
        // Get every subscription for the post that's been commented.
        $event->comment->post->subscriptions->each(function (Subscription $subscription) use ($event) {
            // Send a notification to every subscribed user, unless it's the author of the comment.
            if ($subscription->user->isNot($event->comment->user)) {
                $subscription->user->notify(new NewComment($event->comment));
            }
        });
    }
}
