<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \Conark\Jackhammer\Console\Commands\GenerateAdminController::class,
        \Conark\Jackhammer\Console\Commands\GenerateAdminTemplates::class,
        \Conark\Jackhammer\Console\Commands\GenerateController::class,
        \Conark\Jackhammer\Console\Commands\GeneratePolicy::class,
        \Conark\Jackhammer\Console\Commands\GenerateTransformer::class,
        \Conark\Jackhammer\Console\Commands\Jackhammer::class,
        \Conark\Jackhammer\Console\Commands\UpdateMessages::class,
        \Conark\Jackhammer\Console\Commands\UpdateRepositoryConfiguration::class,
        \Conark\Jackhammer\Console\Commands\UpdateRepositoryServiceProvider::class,
        \Conark\Jackhammer\Console\Commands\UpdateMessages::class,
        \Conark\Jackhammer\Console\Commands\UpdateRoutes::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
    }
}
