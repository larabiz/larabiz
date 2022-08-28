<?php

namespace Tests\Feature\App\Http\Livewire\Comments;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;
use App\Events\Commented;
use App\Models\Subscription;
use App\Http\Livewire\Comments\Form;
use Illuminate\Support\Facades\Event;

class FormTest extends TestCase
{
    public function test_it_stores_comment_and_dispatches_an_event() : void
    {
        Event::fake([Commented::class]);

        // The user who'll comment in this test.
        $commenter = User::factory()->create();

        // We need a post to comment on.
        $post = Post::factory()->forUser()->published()->create();

        // Let's authenticate as the commenter.
        $this->actingAs($commenter);

        // Make sure there are no comments yet.
        $this->assertDatabaseCount(Comment::class, 0);

        Livewire::test(Form::class, [
            'content' => $content = fake()->paragraph(),
            'post' => $post,
            'subscribe' => true,
        ])
            ->call('storeComment')
            ->assertOk()
            ->assertViewIs('livewire.comments.form');

        // Make sure the comment was stored.
        $this->assertDatabaseHas(Comment::class, [
            'user_id' => $commenter->id,
            'post_id' => $post->id,
            'content' => $content,
        ]);

        // Make sure the commenter is subscribed to post.
        $this->assertDatabaseHas(Subscription::class, [
            'user_id' => $commenter->id,
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);

        // Make sure master has been notified of the right new comment.
        Event::assertDispatched(Commented::class, function (Commented $event) use ($commenter) {
            return $event->comment->user_id === $commenter->id;
        });
    }

    public function test_it_needs_content() : void
    {
        $post = Post::factory()->forUser()->published()->create();

        $this->actingAsRandomUser();

        Livewire::test(Form::class, compact('post'))
            ->call('storeComment')
            ->assertHasErrors(['content' => 'required']);
    }

    public function test_it_needs_at_least_3_characters_for_content() : void
    {
        $post = Post::factory()->forUser()->published()->create();

        $this->actingAsRandomUser();

        Livewire::test(Form::class, [
            'content' => 'Fo',
            'post' => $post,
        ])
            ->call('storeComment')
            ->assertHasErrors(['content' => 'min']);
    }

    public function test_it_disallows_guests_to_store_comments() : void
    {
        $post = Post::factory()->forUser()->published()->create();

        $this->assertGuest();

        Livewire::test(Form::class, [
            'content' => fake()->paragraph(),
            'post' => $post,
        ])
            ->call('storeComment')
            ->assertForbidden();
    }
}
