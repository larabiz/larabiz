<?php

namespace App\Console;

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
    }

    protected function commands() : void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
