<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ComputeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeAll';

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
        //echo 'ComputeCoverRealVotes' . "\n";
        $this->call('sb:ComputeCoverRealVotes');
        //echo 'ComputeCoverVotes' . "\n";
        $this->call('sb:ComputeCoverVotes');
        //echo 'ComputeCoverRatio' . "\n";
        $this->call('sb:ComputeCoverRatio');
        //echo 'ComputeConceptRealVotes' . "\n";
        $this->call('sb:ComputeConceptRealVotes');
        //echo 'ComputeConceptVotes' . "\n";
        $this->call('sb:ComputeConceptVotes');
        //echo 'ComputeConceptAdditionalVotes' . "\n";
        $this->call('sb:ComputeConceptAdditionalVotes');
        //echo 'ComputeConceptAdditionalVotesRatio' . "\n";
        $this->call('sb:ComputeConceptAdditionalVotesRatio');
        //echo 'ComputeConceptActions' . "\n";
        $this->call('sb:ComputeConceptActions');
        //echo 'ComputeConceptActionsRatio' . "\n";
        $this->call('sb:ComputeConceptActionsRatio');
        //echo 'ComputeConceptStartRate' . "\n";
        $this->call('sb:ComputeConceptStartRate');
    }
}
