<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\CountsFetchCommand;
use App\Console\Commands\FathomFetchCommand;
use App\Console\Commands\SitemapGenerateCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule) : void
    {
        $schedule->command(FathomFetchCommand::class)
            ->everyTenMinutes();

        $schedule->command(SitemapGenerateCommand::class)
            ->daily();

        $schedule->command(CountsFetchCommand::class)
            ->everyTenMinutes();
    }

    protected function commands() : void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
