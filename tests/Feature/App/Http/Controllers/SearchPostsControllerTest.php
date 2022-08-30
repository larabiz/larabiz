<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Str;

class SearchPostsControllerTest extends TestCase
{
    public function test_it_displays_the_right_results() : void
    {
        Post::factory()->forUser()->published()->create([
            'title' => $title = Str::random(),
        ]);

        Post::factory(10)->forUser()->published()->create();

        Post::factory(10)->forUser()->create();

        $response = $this
            ->get(route('search-posts', ['q' => $title]))
            ->assertOk()
            ->assertViewIs('search.posts')
            ->assertSee($title)
        ;

        $this->assertCount(1, $response->viewData('posts'));
    }
}
