<?php

namespace Tests\Feature\App\Http\Livewire\Comments;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;
use App\Events\Commented;
use Illuminate\Support\Str;
use App\Http\Livewire\Comments\Form;
use Illuminate\Support\Facades\Event;

class FormTest extends TestCase
{
    public function test_it_disallows_guests_to_store_comments() : void
    {
        $post = Post::factory()->forUser()->published()->create();

        $this->assertGuest();

        Livewire::test(Form::class, compact('post') + ['content' => $content = fake()->paragraph()])
            ->call('storeComment')
            ->assertForbidden();
    }

    public function test_it_stores_comments_and_dispatches_an_event() : void
    {
        Event::fake([Commented::class]);

        $user = User::factory()->create();

        $post = Post::factory()->forUser()->published()->create();

        $this->actingAs($user);

        $this->assertDatabaseCount(Comment::class, 0);

        Livewire::test(Form::class, compact('post') + ['content' => $content = fake()->paragraph()])
            ->assertSet('post', $post)
            ->assertSet('content', $content)
            ->call('storeComment')
            ->assertOk()
            ->assertViewIs('livewire.comments.form');

        $this->assertDatabaseHas(Comment::class, [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ] + compact('content'));

        Event::assertDispatched(
            Commented::class, fn ($e) => $e->comment->user_id === $user->id
        );
    }

    public function test_it_needs_content() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->published()->create();

        $this->actingAs($user);

        Livewire::test(Form::class, compact('post'))
            ->call('storeComment')
            ->assertHasErrors(['content' => 'required']);
    }

    public function test_it_needs_at_least_3_characters_for_content() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->published()->create();

        $this->actingAs($user);

        Livewire::test(Form::class, compact('post') + ['content' => Str::random(2)])
            ->call('storeComment')
            ->assertHasErrors(['content' => 'min']);
    }
}
