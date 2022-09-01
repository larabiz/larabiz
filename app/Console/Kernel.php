<?php

namespace App\Console;

use App\Models\Post;
use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\FathomFetchCommand;
use App\Console\Commands\SitemapGenerateCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule) : void
    {
        $schedule->command(FathomFetchCommand::class)
            ->everyTenMinutes()
            ->thenPing(config('services.envoyer.fathom_fetch_heartbeat_url'));

        $schedule->command(SitemapGenerateCommand::class)
            ->daily()
            ->thenPing(config('services.envoyer.sitemap_generate_heartbeat_url'));

        $schedule->call(function () {
            cache()->forever(User::class . '_count', User::count());
            cache()->forever(Subscriber::class . '_count', Subscriber::count());
            cache()->forever(Post::class . '_count', Post::count());
        })->everyTenMinutes();
    }

    protected function commands() : void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
