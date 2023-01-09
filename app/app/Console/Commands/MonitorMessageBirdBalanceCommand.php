<?php

namespace App\Console\Commands;

use App\Mail\LowSmsCreditEmailMail;
use App\Repositories\SMS\MessageBirdRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Sample usage: php artisan import:interested-members /var/www/html/convertcsv.csv
 */
class MonitorMessageBirdBalanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:message-bird-balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitors the MessageBird balance for a targeted credit amount';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bird = new MessageBirdRepository();
        $bal = $bird->getBalance();

        if( $bal->amount <= floatval(env('MESSAGE_BIRD_MINIMUM_CREDIT_AMOUNT', 20)) ) // Enter the target in env. DEFAULT is 20 USD
        {
            $message = new LowSmsCreditEmailMail( $bal->type,  $bal->amount  );

            // Send Email
            Mail::send($message);

            // Send SMS
            $bird->sendSMS([ MessageBirdRepository::phoneToMsisdn( env('ADMIN_MOBILE') ) ], $message->render() );
        }
        $this->info( "-------------------------------------" );
        $this->info( "COMPLETED" );
        return 0;
    }
}
