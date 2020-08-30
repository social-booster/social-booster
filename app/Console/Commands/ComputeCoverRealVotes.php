<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CoverVote;
use App\CoverRealVote;

class ComputeCoverRealVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeCoverRealVotes';

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
        $cover_votes = CoverVote::join('covers', 'cover_votes.cover_id', '=', 'covers.id')
                                  ->select('cover_votes.*', 'covers.lower_concept_id')
                                  ->get();

        $value_per_vote = [];
        $computed = [];
        CoverRealVote::query()->delete();

        foreach ($cover_votes as $cv) {
            if (!array_key_exists($cv->user_id, $value_per_vote)) {
                $user_lower_concept_cover_total = $cover_votes->where('user_id', $cv->user_id)->where('lower_concept_id', $cv->lower_concept_id)->sum('value');
                $value_per_vote[$cv->user_id.'@'.$cv->lower_concept_id] = $user_lower_concept_cover_total > 0 ? 1 / $user_lower_concept_cover_total : 0;
            }
            if (!in_array($cv->user_id.'@'.$cv->cover_id, $computed)) {
                $value = $value_per_vote[$cv->user_id.'@'.$cv->lower_concept_id] * $cover_votes->where('user_id', $cv->user_id)
                                                                                              ->where('cover_id', $cv->cover_id)
                                                                                              ->sum('value');
                if ($value > 0) {
                    CoverRealVote::updateOrCreate(
                        ['user_id' => $cv->user_id,'cover_id' => $cv->cover_id],
                        ['value' => $value]
                    );
                }
                $computed[] = $cv->user_id.'@'.$cv->cover_id;
            }
        }
    }
}
