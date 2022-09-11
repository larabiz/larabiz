<?php

namespace Tests\Feature\App\Console\Commands;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\CountsFetchCommand;
use App\Console\Commands\FathomFetchCommand;
use App\Models\Post;
use App\Models\Subscriber;

class CountsFetchCommandTest extends TestCase
{
    public function test_it_works() : void
    {
        $this->assertFalse(cache()->has(User::class . '_count'));
        $this->assertFalse(cache()->has(Post::class . '_count'));
        $this->assertFalse(cache()->has(Subscriber::class . '_count'));

        Artisan::call(CountsFetchCommand::class);

        $this->assertTrue(cache()->has(User::class . '_count'));
        $this->assertTrue(cache()->has(Post::class . '_count'));
        $this->assertTrue(cache()->has(Subscriber::class . '_count'));
    }
}
