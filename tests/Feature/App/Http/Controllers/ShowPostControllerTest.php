<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

class ShowPostControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        Post::factory(3)->forUser()->create();

        Post::factory(3)->forUser()->asDraft()->create();

        $post = Post::inRandomOrder()->first();

        $response = $this
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertOk()
            ->assertViewIs('posts.show')
        ;

        /* @var \Illuminate\Support\Collection */
        $this->assertInstanceOf(Collection::class, $latest = $response->viewData('others'));
        $this->assertCount(2, $latest);
        $this->assertTrue($latest->doesntContain('id', $post->id));
    }

    public function test_it_redirects_when_slug_is_wrong() : void
    {
        $post = Post::factory()->forUser()->create();

        $this
            ->get(route('posts.show', [$post->random_id, 'foo']))
            ->assertRedirect(route('posts.show', [$post->random_id, $post->slug]))
        ;
    }

    public function test_it_shows_drafts_for_admin() : void
    {
        $post = Post::factory()->for(User::master()->first())->asDraft()->create();

        $this
            ->actingAs($post->user)
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertOk()
        ;
    }

    public function test_it_throws_404_to_anybody_else_for_drafts() : void
    {
        $post = Post::factory()->forUser()->asDraft()->create();

        $this
            ->assertGuest()
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertNotFound()
        ;
    }
}
