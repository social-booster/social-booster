<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cover;
use App\CoverRealVote;

class ComputeCoverVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:ComputeCoverVotes';

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
        foreach (Cover::get() as $cov) {
            $result = Cover::where('id', $cov->id)->update([
            'votes' => CoverRealVote::where('cover_id', $cov->id)->sum('value') * config('cover_vote_factor',1)
            ]);
        }
    }
}
