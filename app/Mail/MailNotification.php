<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $view, $email;
    public function __construct($view, $email)
    {
        $this->view = $view;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->view == 'addProduct'){
            return $this->subject('Transaction')->view('mail.addProduct');
        }else if($this->view == 'invoice'){
            return $this->subject('Transaction')->view('mail.invoice');
        }else if($this->view == 'paid'){
            return $this->subject('Transaction')->view('mail.paid');
        }
    }
}
