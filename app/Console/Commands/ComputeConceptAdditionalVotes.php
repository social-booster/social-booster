<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Concept;
use App\Cover;

class ComputeConceptAdditionalVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeConceptAdditionalVotes';

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
        $concepts = Concept::get();
        $covers = Cover::get();

        $additional_votes = [];
        foreach ($concepts->sortBy('layer') as $con) {
            $lower_concept_votes_sum = 0;
            foreach ($covers->where('upper_concept_id', $con->id) as $cov) {
              $lower_concept_votes_sum += $cov->ratio / 100 * (function () use ($cov,$additional_votes): int {
                if (array_key_exists($cov->lower_concept_id, $additional_votes)) {
                  return $additional_votes[$cov->lower_concept_id];
                }
                return $concepts->where('id',$cov->lower_concept_id)->sum('votes');
              })();
            }
            $value = $lower_concept_votes_sum + $con->votes;
            Concept::where('id', $con->id)->update([
              'additional_votes' => $value
            ]);
            $additional_votes[$con->id] = $value;
        }
    }
}
