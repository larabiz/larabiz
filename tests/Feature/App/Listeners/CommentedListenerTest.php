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

        // Create a bunch of comments each from a different user.

        $post = Post::factory()->forUser()->published()->create();

        $comments = Comment::factory(10)->for($post)->make()->each(function (Comment $comment) {
            $comment->user_id = User::factory()->create()->id;
            $comment->save();
        });

        $notified = $comments->map->user;

        // Create a new comment.

        $comment = Comment::factory()->forUser()->for($post)->create();

        event(new Commented($comment));

        // Excluding the commenter, every user who participated should be notified.

        $notified->each(function (User $user) {
            Notification::assertSentToTimes($user, NewComment::class, 1);
        });

        Notification::assertNotSentTo($comment->user, NewComment::class);
    }
}
