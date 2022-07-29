<?php

namespace Tests\Feature\App\Http\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;
use App\Notifications\NewComment;
use Illuminate\Support\Facades\Notification;

class CommentsTest extends TestCase
{
    public Post $post;

    public function setUp() : void
    {
        parent::setUp();

        Notification::fake();

        $this->post = Post::factory()->forUser()->has(
            Comment::factory(3)->forUser()
        )->create();
    }

    public function test_it_allows_users_to_comment() : void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(\App\Http\Livewire\Comments::class, [
            'post' => $this->post,
            'content' => $content = fake()->paragraph(),
        ])
            ->call('storeComment')
            ->assertOk()
            ->assertSet('content', '')
        ;

        $this->assertDatabaseHas(Comment::class, compact('content') + ['post_id' => $this->post->id]);

        Notification::assertSentToTimes(User::master()->first(), NewComment::class, 1);
    }

    public function test_it_disallows_unverified_users_to_comment() : void
    {
        $this->actingAs(User::factory()->unverified()->create());

        Livewire::test(\App\Http\Livewire\Comments::class, [
            'post' => $this->post,
            'content' => $content = fake()->paragraph(),
        ])
            ->call('storeComment')
            ->assertForbidden()
        ;
    }

    public function test_it_allows_users_to_comment_and_reply_to_another_comment() : void
    {
        $commentRepliedTo = $this->post->comments->first();

        $this->actingAs(User::factory()->create());

        Livewire::test(\App\Http\Livewire\Comments::class, [
            'post' => $this->post,
            'commentRepliedToRandomId' => $commentRepliedTo->random_id,
            'content' => $content = fake()->paragraph(),
        ])
            ->call('storeComment')
            ->assertOk()
            ->assertSet('commentRepliedToRandomId', '')
            ->assertSet('content', '')
        ;

        $this->assertDatabaseHas(Comment::class, compact('content') + [
            'post_id' => $this->post->id,
            'comment_id' => $commentRepliedTo->id,
        ]);

        Notification::assertSentToTimes($commentRepliedTo->user, NewComment::class, 1);

        Notification::assertSentToTimes(User::master()->first(), NewComment::class, 1);
    }
}
