<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Concept;
use App\CoverVote;
use App\CoverRealVote;
use App\ConceptUser;

class ComputeConceptActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeConceptActions';

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
        $cover_real_votes = CoverRealVote::join('covers', 'cover_real_votes.cover_id', '=', 'covers.id')
                                ->select('cover_real_votes.*', 'covers.lower_concept_id')
                                ->get();

        $concept_user = ConceptUser::get();

        foreach (Concept::get() as $con) {
            if ($con->layer !== 5) {
                $actions = $cover_real_votes->where('lower_concept_id', $con->id)->unique('user_id')->count();
            } else {
                $actions = $concept_user->where('concept_id', $con->id)->count();
            }
            Concept::where('id', $con->id)->update([
              'actions' => $actions ?? 0
            ]);
        }
    }
}
