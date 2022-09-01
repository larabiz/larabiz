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
    public function test_it_sends_a_notification_to_subscribed_users() : void
    {
        Notification::fake();

        $post = Post::factory()->forUser()->published()->create();

        // Create users who will be notified about new comments.
        $users = User::factory(10)->create()->each->subscribeTo($post);

        $comment = Comment::factory()->forUser()->for($post)->create();

        event(new Commented($comment));

        // Make sure the subscribed users are notified.

        $users->each(function (User $user) {
            Notification::assertSentTo($user, NewComment::class, 1);
        });

        // Make sure the commenter is not notified.

        Notification::assertNotSentTo($comment->user, NewComment::class);
    }
}
