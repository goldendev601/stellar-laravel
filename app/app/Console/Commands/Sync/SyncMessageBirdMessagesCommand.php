<?php

namespace App\Console\Commands\Sync;

use App\ModelsExtended\SmsMessage;
use App\Repositories\PhoneNumberManipulationTrait;
use App\Repositories\SMS\MessageBirdRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use MessageBird\Exceptions\AuthenticateException;
use MessageBird\Exceptions\BalanceException;
use MessageBird\Exceptions\HttpException;
use MessageBird\Exceptions\RequestException;
use MessageBird\Exceptions\ServerException;

class SyncMessageBirdMessagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:messagebird-messages {from? : the starting date Y-m-d} {to? : the ending date Y-m-d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will copy message bird messages to local database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createMessages(
            $this->argument('from')? Carbon::createFromTimeString($this->argument('from') . " 00:00") : now()->addDays(-1),
            $this->argument('to')? Carbon::createFromTimeString($this->argument('to'). " 00:00") : now()->addWeek(),
        );

        $this->info("\nCompleted\n");
        return 0;
    }

    /**
     * load synchronously only data for today
     *
     * @return void
     */
    public static function loadToday()
    {
        Artisan::call('sync:messagebird-messages', [
          'from' => now()->format('Y-m-d'),
          'to' => now()->addWeek()->format('Y-m-d'),
        ]);
    }

    /**
     * @param Carbon $from
     * @param Carbon $to
     * @return void
     * @throws AuthenticateException
     * @throws BalanceException
     * @throws HttpException
     * @throws RequestException
     * @throws ServerException
     * @throws \JsonException
     */
    private function createMessages(Carbon $from, Carbon $to): void
    {
        $this->info("\nUpdating Messages ...\n");

        $SDK = new MessageBirdRepository();
        $step = 10;

        $messages = $SDK->listMessages($from, $to, 0, $step);
        $offset = $messages->count;

        $bar = $this->output->createProgressBar(intval(ceil($messages->totalCount/$step)));
        $bar->start();
        if( $messages->totalCount )
        {
            while ($bar->getProgressPercent() < 1) {
                foreach ($messages->items as $message ) {
                    try {
                        if( $message->isRecipientsLoaded() )
                        foreach ($message->recipients->items as $key => $recipient)
                        {
                            try {
                                SmsMessage::createOrUpdateFromMessageBird(
                                    $message->id,
                                    PhoneNumberManipulationTrait::phoneToMsisdn( $message->originator ),
                                    strval($recipient->recipient), $message->body,
                                    $recipient->status, $recipient->statusReason,
                                    $recipient->recipientCountry, $recipient->recipientOperator,
                                    optional($recipient->price)->amount, optional($recipient->price)->currency,
                                    // Also #createdDatetime is used here instead of statusDateTime because statusDateTime can be null sometimes
                                    Carbon::createFromTimeString($message->getCreatedDatetime()) // Status DateTime here gotten from MessageBird is in UTC
                                );
                            }catch (\Exception $exception)
                            {
                                Log::error($exception->getMessage(), json_decode(json_encode($recipient), true));
                                throw $exception;
                            }
                        }
                    }catch (\Exception $exception)
                    {
                        // if a message is returned with no recipients
                        Log::error("Message: doesn't contain any recipient or not well structured! " . $exception->getMessage(),
                            json_decode(json_encode($message), true)
                        );
                        throw $exception;
                    }
                }
                $messages = $SDK->listMessages( $from, $to,$offset + ($bar->getProgress() * $step), $step);
                $bar->advance();
            }
        }
        $bar->finish();
        $this->info("\nCompleted Creating Messages ...\n");
    }
}
