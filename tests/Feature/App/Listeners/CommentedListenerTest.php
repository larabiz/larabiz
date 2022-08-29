<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Events\Commented;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Users\Comments\NewComment;

class CommentedListenerTest extends TestCase
{
    public function test_it_sends_a_notification_to_master() : void
    {
        Notification::fake();

        $master = User::master()->first();

        // Create a post with a bunch of comments.

        $post = Post::factory()->for($master)->published()->create();

        // Create users who will be notified about new comments.

        $users = User::factory(10)->create()->each->subscribeTo($post);

        // Create a new comment.

        $comment = Comment::factory()->for($master)->for($post)->create();

        event(new Commented($comment));

        // Make sure the subscribed users are notified.

        $users->each(function (User $user) {
            Notification::assertSentTo($user, NewComment::class, 1);
        });

        // Make sure the commenter is not notified.

        Notification::assertNotSentTo($comment->user, NewComment::class);
    }
}
