<?php

namespace App\Repositories\SMS;

use MessageBird\Common\HttpClient;

class Messages extends \MessageBird\Resources\Messages
{
    /**
     * @var Message
     */
    protected $object;

    /**
     * @var MessageResponse
     */
    protected $responseObject;

    public function __construct(HttpClient $httpClient)
    {
        parent::__construct($httpClient);
        $this->object = new Message();
        $this->setResponseObject(new MessageResponse());
    }

    /**
     * @param array|null $parameters
     * @return MessageList
     * @throws \JsonException
     * @throws \MessageBird\Exceptions\AuthenticateException
     * @throws \MessageBird\Exceptions\BalanceException
     * @throws \MessageBird\Exceptions\HttpException
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\ServerException
     * @throws \Exception
     */
    public function getList(?array $parameters = []): MessageList
    {
        // Response here is not consistent.
        // If recipient count is high, it doesn't parse it
        //
        //{
        //  "direction": "mt",
        //  "type": "sms",
        //  "originator": "+13323227385",
        //  "body": "Welcome to the Stellar private alpha, Sean! I'm sure you're asking, \"What's next?\" Reply YES to get started.",
        //  "reference": null,
        //  "validity": null,
        //  "gateway": 10,
        //  "typeDetails": [
        //
        //  ],
        //  "datacoding": "plain",
        //  "mclass": 1,
        //  "scheduledDatetime": null,
        //  "recipients": {
        //    "totalCount": 150,
        //    "totalSentCount": 150,
        //    "totalDeliveredCount": 144,
        //    "totalDeliveryFailedCount": 6,
        //    "href": "https://rest.messagebird.com/messages/7a93b65b7bc74421b0e0a69d88bdf647/recipients"
        //  },
        //  "reportUrl": null,
        //  "id": "7a93b65b7bc74421b0e0a69d88bdf647"
        //}
        //
        //
        // Normal response
        //   +direction: "mt"
        //  +type: "sms"
        //  +originator: "+13323227385"
        //  +body: "Stellar received this message from 18564306709: Yes"
        //  +reference: null
        //  +validity: null
        //  +gateway: 10
        //  +typeDetails: []
        //  +datacoding: "plain"
        //  +mclass: 1
        //  +scheduledDatetime: null
        //  +recipients: App\Repositories\SMS\Recipients^ {#1017
        //    +totalCount: 1
        //    +totalSentCount: 1
        //    +totalDeliveredCount: 1
        //    +totalDeliveryFailedCount: 0
        //    +items: array:1 [
        //      0 => App\Repositories\SMS\Recipient^ {#1020
        //        +recipient: 19174009674
        //        +status: "delivered"
        //        +statusDatetime: "2022-07-18T17:39:42+00:00"
        //        +statusReason: "successfully delivered"
        //        +statusErrorCode: null
        //        +recipientCountry: "United States of America"
        //        +recipientCountryPrefix: 1
        //        +recipientOperator: "T-Mobile"
        //        +mccmnc: "310260"
        //        +mcc: "310"
        //        +mnc: "260"
        //        +messageLength: 51
        //        +messagePartCount: 1
        //        +price: App\Repositories\SMS\SmsPrice^ {#1021
        //          +amount: 0.006
        //          +currency: "USD"
        //        }
        //        +messageId: "e07b850748af4ddd870af279147ea233"
        //      }
        //    ]
        //    +messageId: "e07b850748af4ddd870af279147ea233"
        //  }
        //  +reportUrl: null
        //  #createdDatetime: "2022-07-18T17:39:40+00:00"
        //  +id: "e07b850748af4ddd870af279147ea233"
        //}
        [$status, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_GET,
            $this->resourceName,
            $parameters
        );

        if ($status === 200) {
            $body = json_decode($body, null, 512, \JSON_THROW_ON_ERROR);

            $items = $body->items;
            unset($body->items);

            $baseList = new MessageList();
            $baseList->loadFromArray($body);

            $objectName = $this->object;

            $baseList->items = [];

            if ($items === null) {
                return $baseList;
            }

            foreach ($items as $item) {
                /** @psalm-suppress UndefinedClass */
                $object = new $objectName($this->httpClient);

                $message = $object->loadFromArray($item);
                $baseList->items[] = $message;
            }

            return $baseList;
        }

        throw new \Exception('Not Implemented!');
    }

    public function getResponseObject(): MessageResponse
    {
        return $this->responseObject;
    }
}