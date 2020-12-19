<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Concept;

class ComputeConceptStartRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeConceptStartRate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (Concept::get() as $con) {
            $response = Concept::where('id', $con->id)->update([
              'start_rate' => $con->additional_votes_ratio > 0 ? $con->actions_ratio / $con->additional_votes_ratio * 100 : 10
            ]);
        }
    }
}
