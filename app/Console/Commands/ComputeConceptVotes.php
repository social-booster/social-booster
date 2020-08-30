<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ConceptRealVote;
use App\Concept;

class ComputeConceptVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeConceptVotes';

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
            Concept::where('id', $con->id)->update([
          'votes' => ConceptRealVote::where('concept_id', $con->id)->sum('value')
        ]);
        }
    }
}
