<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Pagination\Paginator;

class ListPostsControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        Post::factory(10)->forUser()->create();
        Post::factory(10)->forUser()->asDraft()->create();

        $response = $this
            ->get(route('posts.index'))
            ->assertOk()
            ->assertViewIs('posts.index')
        ;

        $this->assertInstanceOf(Paginator::class, $posts = $response->viewData('posts'));
        $this->assertCount(10, $posts);
    }
}
