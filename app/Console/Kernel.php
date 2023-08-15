<?php

namespace App\Console;

use App\Console\Commands\User\{AddToMember, CheckExpiration};

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AddToMember::class,
        CheckExpiration::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $logPath = config('schedule.log_path', 'logs/schedule.log');
        $logOutput = storage_path($logPath);

        $event = $schedule->command(CheckExpiration::class)
            ->sendOutputTo($logOutput)
            ->onFailure(function (Stringable $output) {
                Log::error("Failure. Message: $output");
            });

        $expirationCron = config('schedule.check_expiration.cron');
        if ($expirationCron) {
            $event->cron($expirationCron);
        } else {
            $event->everyTenMinutes();
        }
    }
}
