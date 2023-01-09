<?php

namespace App\Repositories\SMS;

/**
 * @property array|Recipient[] $items
 */
class Recipients extends \MessageBird\Objects\Recipients
{
    /**
     * @var string
     */
    public string $messageId;

    public function loadFromStdclass(\stdClass $object): self
    {
        parent::loadFromStdclass($object);

        $this->items = array_map(function ( $item ){
            $recipient = new Recipient();
            $recipient->messageId = $this->messageId;
            $recipient->loadFromStdclass($item);
            return $recipient;
        }, $object->items );

        return $this;
    }
}