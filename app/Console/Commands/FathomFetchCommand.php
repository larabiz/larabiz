<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Fathom\Client;
use Illuminate\Console\Command;

class FathomFetchCommand extends Command
{
    protected $signature = 'fathom:fetch';

    protected $description = 'Fetch data from Fathom';

    public function handle(Client $client) : int
    {
        cache()->forever('pageviews', $client->pageviewsCountFromLastThirtyDays());

        cache()->forever('visits', $client->visitsCountFromLastThirtyDays());

        $client->pageviewsCountForEachPage()->groupBy(function ($item) {
            return preg_replace('/\/blog\/(\w{6})\/[\w-]+/', '$1', $item['pathname']);
        })->each(function ($item, $key) {
            Post::where('random_id', $key)->update(['views' => $item->sum('pageviews')]);
        });

        $this->info('Data succesfully fetched from Fathom');

        return Command::SUCCESS;
    }
}
