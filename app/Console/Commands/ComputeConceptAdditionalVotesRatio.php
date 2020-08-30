<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Concept;

class ComputeConceptAdditionalVotesRatio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeConceptAdditionalVotesRatio';

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
        $total_layer_additional_votes = [];
        foreach ($concepts->unique('layer') as $layer) {
            $total_layer_additional_votes[$layer->layer] = $concepts->where('layer', $layer->layer)->sum('additional_votes') . "\n";
        }
        foreach ($concepts as $con) {
            if ($total_layer_additional_votes[$con->layer] != 0) {
                $value = (int)$con->additional_votes / (int)$total_layer_additional_votes[$con->layer] * 100 . "\n";
            }
            Concept::where('id', $con->id)->update([
          'additional_votes_ratio' => $value
        ]);
        }
    }
}
