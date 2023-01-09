<?php

namespace App\Repositories\SMS;

use App\ModelsExtended\Member;
use App\Repositories\PhoneNumberManipulationTrait;
use Carbon\Carbon;
use MessageBird\Exceptions\AuthenticateException;
use MessageBird\Exceptions\BalanceException;
use MessageBird\Exceptions\HttpException;
use MessageBird\Exceptions\RequestException;
use MessageBird\Exceptions\ServerException;
use MessageBird\Objects\Balance;
use MessageBird\Objects\BaseList;
use MessageBird\Objects\Conversation\Conversation;
use MessageBird\Objects\Hlr;
use MessageBird\Objects\Lookup;
use MessageBird\Objects\Message;
use MessageBird\Objects\MessageResponse;
use MessageBird\Objects\Verify;
use MessageBird\Objects\VoiceMessage;

/**
 * https://github.com/messagebird/php-rest-api/tree/master/examples
 */
class MessageBirdRepository
{
    use PhoneNumberManipulationTrait;

    private \MessageBird\Client $messageBird;

    public function __construct()
    {
        $this->messageBird = new Client(env('MESSAGE_BIRD_ACCESS_KEY'));
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return array|Balance|BaseList|Conversation|Hlr|Lookup|Message|MessageResponse|Verify|VoiceMessage|null
     * @throws \JsonException
     * @throws \MessageBird\Exceptions\AuthenticateException
     * @throws \MessageBird\Exceptions\BalanceException
     * @throws \MessageBird\Exceptions\HttpException
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\ServerException
     */
    public function getGroups(int $offset = 0, int $limit = 200): Message|VoiceMessage|BaseList|Hlr|Lookup|MessageResponse|array|Verify|Balance|Conversation|null
    {
        return $this->messageBird->groups->getList($this->getOffsetParams($offset, $limit));
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return array|Balance|BaseList|Conversation|Hlr|Lookup|Message|MessageResponse|Verify|VoiceMessage|null
     * @throws \JsonException
     * @throws \MessageBird\Exceptions\AuthenticateException
     * @throws \MessageBird\Exceptions\BalanceException
     * @throws \MessageBird\Exceptions\HttpException
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\ServerException
     */
    public function getContacts(int $offset = 0, int $limit = 200): Message|VoiceMessage|BaseList|Hlr|Lookup|MessageResponse|array|Verify|Balance|Conversation|null
    {
        return $this->messageBird->contacts->getList($this->getOffsetParams($offset, $limit)) ;
    }

    /**
     * @param mixed $offset
     * @param int $limit
     * @return array
     */
    private function getOffsetParams(mixed $offset, int $limit): array
    {
        // max limit is 200
        $offset = max($offset, 0);
        $limit = $limit > 0 && $limit <= 200 ? $limit: 200;

        return ['offset' => $offset, 'limit' => $limit];
    }

    /**
     * It returns the list of the recipients sent to if successful
     * Recipients must be Msidn, a phone number without +
     *
     * @param array | string [] $recipients
     * @param string $body
     * @return MessageResponse
     * @throws \JsonException
     * @throws \MessageBird\Exceptions\HttpException
     */
    public function sendSMS(array $recipients, string $body)
    {

        $message             = new \MessageBird\Objects\Message();
        $message->originator = env('MESSAGE_BIRD_SENDER');
        $message->recipients = collect($recipients)->map(fn( string $val ) => self::phoneToMsisdn( $val ))->toArray();
        $message->body       = $body;
//        dd($message);
        try {

            return $this->messageBird->messages->create($message);
            //  The status of the msisdns. Possible values: sent, absent, active, unknown, and failed
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            // That means that your accessKey is unknown
            throw new \Exception( 'wrong credential for SMS login' , 0, $e) ;
        } catch (\MessageBird\Exceptions\BalanceException $e) {
            // That means that you are out of credits, so do something about it.
            throw new \Exception( 'No credit for sending SMS', 0, $e ) ;
        }
    }

    /**
     * https://developers.messagebird.com/api/sms-messaging/#list-scheduled-messages
     *
     * @param Carbon $from
     * @param Carbon $to
     * @param int $offset
     * @param int $limit
     * @return MessageList
     * @throws \JsonException
     * @throws AuthenticateException
     * @throws BalanceException
     * @throws HttpException
     * @throws RequestException
     * @throws ServerException
     */
    public function listMessages(Carbon $from, Carbon $to, int $offset = 0, int $limit = 200): MessageList
    {
        // Pagination limit must be less than 10 to 200
        return $this->messageBird->messages->getList(array_merge([
            "from" => $from->format("Y-m-d") . " 00:00:00",
            "until" => $to->format("Y-m-d") . " 00:00:00",
        ],$this->getOffsetParams($offset, $limit) ));
    }

    /**
     * https://github.com/messagebird/php-rest-api/blob/master/examples/balance-view.php
     * https://developers.messagebird.com/api/balance/#get-your-balance
     *
     * @return Balance
     * @throws AuthenticateException
     * @throws BalanceException
     * @throws HttpException
     * @throws RequestException
     * @throws ServerException
     */
    public function getBalance(): Balance
    {
        // Pagination limit must be less than 10 to 200
        return $this->messageBird->balance->read();
    }

//    /**
//     * Requires configuration and Virtual Mobile Number
//     *
//     * https://dashboard.messagebird.com/en/channels
//     * https://developers.messagebird.com/api/conversations/#channel-object
//     * https://developers.messagebird.com/api/conversations/#start-conversation
//     *
//     * @param int $offset
//     * @param int $limit
//     * @return void
//     * @throws \JsonException
//     * @throws \MessageBird\Exceptions\AuthenticateException
//     * @throws \MessageBird\Exceptions\BalanceException
//     * @throws \MessageBird\Exceptions\HttpException
//     * @throws \MessageBird\Exceptions\RequestException
//     * @throws \MessageBird\Exceptions\ServerException
//     */
//    public function listConversation(int $offset = 0, int $limit = 20)
//    {
//        // Pagination limit must be less than 20
//        $conversations = $this->messageBird->conversations->getList($this->getOffsetParams($offset, $limit));
//        dd($conversations);
//    }
}
