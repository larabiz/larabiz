<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Collection;

class ShowPostControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        $posts = Post::factory(10)->forUser()->create();

        $post = $posts->random();

        $response = $this
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertOk()
            ->assertViewIs('posts.show')
        ;

        $this->assertInstanceOf(Collection::class, $latest = $response->viewData('others'));
        $this->assertCount(6, $latest);
    }

    public function test_it_redirects_when_slug_is_wrong() : void
    {
        $post = Post::factory()->forUser()->create();

        $this
            ->get(route('posts.show', [$post->random_id, 'foo']))
            ->assertRedirect(route('posts.show', [$post->random_id, $post->slug]))
        ;
    }
}
