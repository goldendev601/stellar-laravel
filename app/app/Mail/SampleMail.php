<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SampleMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     */
  public function __construct(string $target_email = "ibukunoreofe@gmail.com" )
    {

        $this->subject = "TESTING SMTP | " . env( "APP_NAME" ) ;
        $this->to( $target_email );

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view( "email.sample_mail" );
    }
}
