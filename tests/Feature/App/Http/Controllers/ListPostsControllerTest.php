<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Collection;

class ListPostsControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        Post::factory(10)->forUser()->create();

        $response = $this
            ->get(route('posts.index'))
            ->assertOk()
            ->assertViewIs('posts.index')
        ;

        $this->assertInstanceOf(Collection::class, $response->viewData('posts'));
    }
}
