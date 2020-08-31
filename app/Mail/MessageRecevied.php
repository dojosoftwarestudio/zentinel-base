<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageRecevied extends Mailable
{
    use Queueable, SerializesModels;
    public $msg;
    public function __construct($msg)
    {
        $this->msg = $msg;
    }
    public function build()
    {
        return $this->view('mails.asignacion');
    }
}
