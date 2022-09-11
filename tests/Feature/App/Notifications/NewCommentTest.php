<?php

namespace Tests\Feature\App\Notifications;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use App\Notifications\NewComment;
use Illuminate\Notifications\Messages\MailMessage;

class NewCommentTest extends TestCase
{
    public function test_it_works() : void
    {
        $post = Post::factory()->forUser()->create();

        $comment = Comment::factory()->forUser()->for($post)->create();

        $notification = new NewComment(
            postTitle: $post->title,
            commentAuthorUsername: $comment->user->username,
            linkToComment: route('posts.show', [$post->random_id, $post->slug]) . '#comment-' . $comment->id
        );

        $this->assertEquals(['database', 'mail'], $notification->via());

        $array = $notification->toArray();

        $this->assertEquals($notification->linkToComment, $array['actionUrl']);
        $this->assertStringContainsString($notification->commentAuthorUsername, $array['message']);
        $this->assertStringContainsString($notification->postTitle, $array['message']);

        $mail = $notification->toMail();

        $this->assertInstanceOf(MailMessage::class, $mail);
    }
}
