<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Collection;

class HomeControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        Post::factory(10)->forUser()->create();

        $response = $this
            ->get(route('home'))
            ->assertOk()
            ->assertViewIs('home')
        ;

        $this->assertInstanceOf(Collection::class, $latest = $response->viewData('latest'));
        $this->assertCount(6, $latest);
    }
}
