<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Collection;

class ShowPostControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        Post::factory(20)->forUser()->create();

        $post = Post::inRandomOrder()->first();

        $response = $this
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertOk()
            ->assertViewIs('posts.show')
        ;

        /* @var \Illuminate\Support\Collection */
        $this->assertInstanceOf(Collection::class, $latest = $response->viewData('others'));
        $this->assertCount(6, $latest);
        $this->assertTrue($latest->doesntContain('id', $post->id));
    }

    public function test_it_redirects_when_slug_is_wrong() : void
    {
        $post = Post::factory()->forUser()->create();

        $this
            ->get(route('posts.show', [$post->random_id, 'foo']))
            ->assertStatus(301)
            ->assertLocation(route('posts.show', [$post->random_id, $post->slug]))
        ;
    }
}
