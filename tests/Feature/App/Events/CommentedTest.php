<?php

namespace Tests\Feature\App\Events;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use App\Events\Commented;

class CommentedTest extends TestCase
{
    public function test_it_instanciates_without_errors_and_has_a_public_comment_property() : void
    {
        $event = new Commented(
            Comment::factory()->forUser()->for(
                Post::factory()->forUser()
            )->make()
        );

        $this->assertInstanceOf(Comment::class, $event->comment);
    }
}
