<?php

namespace Tests\Feature\App\Http\Livewire\Comments;

use Tests\TestCase;
use App\Models\Post;
use Livewire\Livewire;
use App\Models\Comment;
use Illuminate\Support\Carbon;
use App\Http\Livewire\Comments\Listing;

class ListingTest extends TestCase
{
    public function test_it_lists_comments_by_creation_date_in_asc_order() : void
    {
        $post = Post::factory()->forUser()->published()->create();

        Carbon::setTestNow();

        $firstComment = Comment::factory()->forUser()->for($post)->create();

        Carbon::setTestNow(now()->addDay());

        $secondComment = Comment::factory()->forUser()->for($post)->create();

        $component = Livewire::test(Listing::class, compact('post'))
            ->assertOk()
            ->assertViewIs('livewire.comments.listing');

        $this->assertCount(2, $component->comments);
        $this->assertEquals($firstComment->id, $component->comments->get(0)->id);
        $this->assertEquals($secondComment->id, $component->comments->get(1)->id);
    }
}
