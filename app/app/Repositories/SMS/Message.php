<?php

namespace App\Repositories\SMS;

/**
 * https://developers.messagebird.com/api/sms-messaging/#the-message-object
 * @property Recipients|\stdClass|null $recipients
 */
class Message extends \MessageBird\Objects\Message
{
    const DIRECTION__MOBILE_TERMINATED = "mt";
    const DIRECTION__MOBILE_ORIGINATED = "mo";

    // Possible values: scheduled, sent, buffered, delivered, expired, and delivery_failed
    // sent, absent, active, unknown, and failed
    const DELIVERY__ACTIVE = "active";
    const DELIVERY__UNKNOWN = "unknown";
    const DELIVERY__SENT_FAILED = "failed";
    const DELIVERY__SENT = "sent";
    const DELIVERY__ABSENT = "absent";
    const DELIVERY__BUFFERED = "buffered";
    const DELIVERY__DELIVERED = "delivered";
    const DELIVERY__EXPIRED = "expired";
    const DELIVERY__FAILED = "delivery_failed";
    const DELIVERY__SCHEDULED = "scheduled";

    /**
     * @var string
     */
    public string $id;

    /**
     * An object of recipients
     *
     * @var Recipients|\stdClass|null
     */
    public $recipients = null;

    /**
     * @deprecated 2.2.0 No longer used by internal code, please switch to {@see self::loadFromStdclass()}
     *
     * @param mixed $object
     *
     * @return self
     */
    public function loadFromArray($object): self
    {
        parent::loadFromArray(json_decode(json_encode($object),true));
        if (!empty(optional($object->recipients)->items)) {
            $this->recipients = new Recipients();
            $this->recipients->messageId = $this->id;
            $this->recipients->loadFromStdclass($object->recipients);
        }

        return $this;
    }

    /**
     * @param \stdClass $object
     * @return self
     */
    public function loadFromStdclass(\stdClass $object): self
    {
        parent::loadFromStdclass($object);

        if (!empty(optional($object->recipients)->items)) {
            $this->recipients = new Recipients();
            $this->recipients->messageId = $this->id;
            $this->recipients->loadFromStdclass($object->recipients);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isRecipientsLoaded(): bool
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

        return $this->recipients instanceof Recipients;
    }
}