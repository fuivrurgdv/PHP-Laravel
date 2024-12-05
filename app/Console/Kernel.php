<?php

namespace App\Console;

use App\Console\Commands\SendReminderEmails;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Đặt lịch cho lệnh gửi email vào thời gian định kỳ

        // Log để kiểm tra lịch trình chạy
        $schedule->command('emails:send-reminders')->everyMinute();
        $schedule->command('payroll:calculate')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    // protected $routeMiddleware = [
    //     // ...
    //     'checklogin' => \App\Http\Middleware\CheckLogin::class,
    // ];
   

}
