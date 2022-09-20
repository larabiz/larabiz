<?php

namespace Tests\Feature\App\Notifications;

use Tests\TestCase;
use App\Notifications\NewComment;
use Illuminate\Notifications\Messages\MailMessage;

class NewCommentTest extends TestCase
{
    public function test_it_works() : void
    {
        $notification = new NewComment(
            postTitle: fake()->sentence(),
            commentAuthorUsername: fake()->userName(),
            linkToComment: 'https://example.com/foo/bar',
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
