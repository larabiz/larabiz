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
    public function test_it_rewards_the_user_with_experience_points_and_sends_notifications_to_master() : void
    {
        Notification::fake();

        $comment = Comment::factory()->forUser()->for(
            Post::factory()->forUser()->published()
        )->create();

        // User has no experience points yet.
        $this->assertEquals(0, $comment->user->sumExperienceGainsPoints());

        event(new Commented($comment));

        // Master should be notified of the new comment.
        Notification::assertSentToTimes(User::master()->first(), NewComment::class, 1);

        // The event has been triggered. 30 points should be gained.
        $this->assertEquals(30, $comment->user->sumExperienceGainsPoints());
    }
}
