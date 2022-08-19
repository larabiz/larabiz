<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Events\Commented;
use App\Notifications\NewComment;
use Illuminate\Support\Facades\Notification;

class CommentedListenerTest extends TestCase
{
    public function test_it_sends_a_notification_to_master() : void
    {
        Notification::fake();

        $comment = Comment::factory()->forUser()->for(
            Post::factory()->forUser()->published()
        )->create();

        event(new Commented($comment));

        // Master should be notified of the new comment.
        Notification::assertSentToTimes(User::master()->first(), NewComment::class, 1);
    }
}
