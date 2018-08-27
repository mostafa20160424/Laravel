<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      //php artisan make:mail Class Name --markdown=folder.folder.view name create Mail with view MessageMail
        return $this->markdown('email.TestMail.MessageMail')->with('message',$this->data);
        //with('key',value); to print $key in MessageMail view
    }
}
