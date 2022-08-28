<?php

namespace Tests\Feature\App\Console\Commands;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\FathomFetchCommand;

class FathomFetchCommandTest extends TestCase
{
    public function test_it_works() : void
    {
        Http::fake([
            'api.usefathom.com/*' => Http::response([[
                'pageviews' => 1234,
                'visits' => 1234,
            ]]),
        ]);

        Artisan::call(FathomFetchCommand::class);

        $this->assertEquals(1234, cache()->get('pageviews'));

        $this->assertEquals(1234, cache()->get('visits'));
    }
}
