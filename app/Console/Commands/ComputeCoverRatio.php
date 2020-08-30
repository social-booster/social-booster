<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cover;

class ComputeCoverRatio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeCoverRatio';

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
        $covers = Cover::get();
        $lower_concept_total_votes = [];
        foreach ($covers->unique('lower_concept_id') as $cov) {
            $value = $covers->where('lower_concept_id', $cov->lower_concept_id)->sum('votes');
            $lower_concept_total_votes[$cov->lower_concept_id] = $value;
        }
        foreach ($covers as $cov) {
            if ($lower_concept_total_votes[$cov->lower_concept_id] !== 0) {
                $value = (int)$cov->votes / (int)$lower_concept_total_votes[$cov->lower_concept_id] * 100 . "\n";
            } else {
                $value = 0;
            }
            Cover::where('id', $cov->id)->update([
              'ratio' => $value
            ]);
        }
    }
}
