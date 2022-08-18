<?php

namespace Tests\Feature\App\Models;

use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    public function test_it_adds_a_draft_status_to_a_new_post() : void
    {
        $post = Post::factory()->forUser()->create();

        $this->assertEquals('draft', $post->latestStatus()->name);
        $this->assertEquals(1, $post->statuses()->count());
    }

    public function test_it_does_not_set_a_new_status_at_each_save() : void
    {
        $post = Post::factory()->forUser()->create();

        $this->assertEquals(1, $post->statuses()->count());

        $post->update(['title' => fake()->sentence()]);

        $this->assertEquals(1, $post->statuses()->count());
    }
}
