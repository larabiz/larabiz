<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class FathomFetchCommand extends Command
{
    protected $signature = 'fathom:fetch';

    protected $description = 'Fetch data from Fathom';

    public function handle() : int
    {
        cache()->forever('pageviews', $this->pageviews());

        cache()->forever('visits', $this->visits());

        return Command::SUCCESS;
    }

    protected function pageviews() : int
    {
        return $this
            ->request()
            ->get('https://api.usefathom.com/v1/aggregations', [
                'aggregates' => 'pageviews',
                'date_from' => now()->subDays(30)->toDateTimeString(),
                'entity_id' => config('services.fathom.site_id'),
                'entity' => 'pageview',
            ])
            ->throw()
            ->collect()
            ->get(0)['pageviews'];
    }

    protected function visits() : int
    {
        return $this
            ->request()
            ->get('https://api.usefathom.com/v1/aggregations', [
                'aggregates' => 'visits',
                'date_from' => now()->subDays(30)->toDateTimeString(),
                'entity_id' => config('services.fathom.site_id'),
                'entity' => 'pageview',
            ])
            ->throw()
            ->collect()
            ->get(0)['visits'];
    }

    protected function request() : PendingRequest
    {
        return Http::withToken(config('services.fathom.api_token'));
    }
}
