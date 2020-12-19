<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ConceptVote;
use App\ConceptRealVote;

class ComputeConceptRealVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeConceptRealVotes';

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
        $concept_votes = ConceptVote::get();

        $value_per_vote = [];
        $computed = [];
        ConceptRealVote::query()->delete();

        foreach ($concept_votes->unique('user_id') as $cv) {
            $value_per_vote[$cv->user_id] = 1 / $concept_votes->where('user_id', $cv->user_id)->sum('value');
        }

        foreach ($concept_votes as $cv) {
            if (!in_array($cv->user_id.'@'.$cv->concept_id, $computed)) {
                $value = $concept_votes->where('user_id', $cv->user_id)->where('concept_id', $cv->concept_id)->sum('value') * $value_per_vote[$cv->user_id];
                if ($value > 0) {
                    ConceptRealVote::updateOrCreate(
                        ['user_id' => $cv->user_id,'concept_id' => $cv->concept_id],
                        ['value' => $value]
                    );
                }
                $computed[] = $cv->user_id.'@'.$cv->concept_id;
            }
        }
    }
}
