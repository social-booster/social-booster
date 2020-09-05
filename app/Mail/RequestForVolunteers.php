<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestForVolunteers extends Mailable
{
    use Queueable, SerializesModels;

    protected $concept;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($concept)
    {
        $this->concept = $concept;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.RequestForVolunteers')
                    ->subject('ボランティアを募集しています')
                    ->with(['concept' => $this->concept]);
    }
}
