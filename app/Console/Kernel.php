<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\{
  ComputeCoverRealVotes,
  ComputeCoverRatio,
  ComputeCoverVotes,
  ComputeConceptVotes,
  ComputeConceptRealVotes,
  ComputeConceptAdditionalVotes,
  ComputeConceptAdditionalVotesRatio,
  ComputeConceptActions,
  ComputeConceptActionsRatio,
  ComputeConceptStartRate,
  ComputeAll
};

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ComputeCoverRealVotes::class,
        ComputeCoverRatio::class,
        ComputeCoverVotes::class,
        ComputeConceptVotes::class,
        ComputeConceptRealVotes::class,
        ComputeConceptAdditionalVotes::class,
        ComputeConceptAdditionalVotesRatio::class,
        ComputeConceptActions::class,
        ComputeConceptActionsRatio::class,
        ComputeConceptStartRate::class,
        ComputeAll::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->command('sb:ComputeAll')->daily();
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
