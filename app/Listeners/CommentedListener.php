<?php

namespace App\Listeners;

use App\Models\Comment;
use App\Events\Commented;
use App\Notifications\Users\Comments\NewComment;

class CommentedListener
{
    public function handle(Commented $event) : void
    {
        $event->comment->post->comments->each(function (Comment $comment) use ($event) {
            if ($comment->user->isNot($event->comment->user)) {
                $comment->user->notify(new NewComment($event->comment));
            }
        });
    }
}
