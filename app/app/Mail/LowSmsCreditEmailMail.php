<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowSmsCreditEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $currency;
    private float $amount;

    /**
     * Create a new message instance.
     *
     */
  public function __construct( string $currency, float $amount )
    {
        $this->subject = "Balance running low for SMS";
        $this->to( env('ADMIN_EMAIL') );
        
        $this->currency = $currency;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text( "email.low_sms_credit_email")
            ->withCurrency( $this->currency )
            ->withAmount( $this->amount );
    }
}
