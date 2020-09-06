<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Concept;
use App\User;
use App\Mail\RequestForVolunteers;

class SendMailRequestForVolunteers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:SendMailRequestForVolunteers';

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
      $concept = Concept::orderBy('concepts.start_rate', 'asc')
                    ->orderBy('concepts.additional_votes_ratio', 'desc')
                    ->first();

      Mail::to(User::pluck('email'))->send(new RequestForVolunteers($concept));
    }
}
