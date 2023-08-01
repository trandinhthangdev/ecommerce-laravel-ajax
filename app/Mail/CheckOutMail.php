<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\CheckOut;
class CheckOutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $check_out;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($check_out)
    {
        $this->check_out = $check_out;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.check_out');
    }
}
