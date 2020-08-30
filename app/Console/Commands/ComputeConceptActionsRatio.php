<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Concept;

class ComputeConceptActionsRatio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeConceptActionsRatio';

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
        foreach ($concepts->unique('layer') as $con) {
            $layer_sum[$con->layer] = $concepts->where('layer', $con->layer)->sum('actions');
        }

        foreach ($concepts as $con) {
            $value = $layer_sum[$con->layer] > 0 ? $con->actions / $layer_sum[$con->layer] * 100 : 0;
            Concept::where('id', $con->id)->update([
            'actions_ratio' => $value
          ]);
        }
    }
}
