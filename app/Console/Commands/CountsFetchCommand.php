<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use App\Fathom\Client;
use App\Models\Subscriber;
use Illuminate\Console\Command;

class CountsFetchCommand extends Command
{
    protected $signature = 'counts:fetch';

    protected $description = 'Fetch counts from the database';

    public function handle(Client $client) : int
    {
        cache()->forever(User::class . '_count', User::verified()->count());
        cache()->forever(Subscriber::class . '_count', Subscriber::confirmed()->count());
        cache()->forever(Post::class . '_count', Post::count());

        $this->info('Counts succesfully fetched from the database');

        return Command::SUCCESS;
    }
}
