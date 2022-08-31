<?php

namespace App\Console\Commands;

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

        $this->info('Data succesfully fetched from Fathom');

        return Command::SUCCESS;
    }
}
