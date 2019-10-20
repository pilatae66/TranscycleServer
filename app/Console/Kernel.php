<?php

namespace App\Console;

use App\User;
use Carbon\Carbon;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // $users = User::whereHas('purchased_product')->with('purchased_product')->get();
        // foreach ($users as $key => $user) {
        //     if (Carbon::parse($user->purchased_product->due_date)->subDay(1)->day == Carbon::now()->day) {
        //         $schedule->command("customer:beforedue {$user->firstname}");
        //     }
        //     else if (Carbon::parse($user->purchased_product->due_date)->day <= Carbon::now()->day) {
        //         $schedule->command("customer:afterdue {$user->firstname}");
        //     }
        // }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
