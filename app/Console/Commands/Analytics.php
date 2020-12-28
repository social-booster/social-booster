<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Concept;
use App\User;

class Analytics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:Analytics';

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
        $users = User::get();

        echo "layer-1   " . $concepts->where('layer',1)->count() . "\n";
        echo "layer-2   " . $concepts->where('layer',2)->count() . "\n";
        echo "layer-3   " . $concepts->where('layer',3)->count() . "\n";
        echo "layer-4   " . $concepts->where('layer',4)->count() . "\n";
        echo "layer-5   " . $concepts->where('layer',5)->count() . "\n";

        echo "users  " . $users->count() . "\n";
    }
}
