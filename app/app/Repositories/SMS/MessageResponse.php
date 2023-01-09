<?php

namespace App\Repositories\SMS;

class MessageResponse extends \MessageBird\Objects\MessageResponse
{
    /**
     * An array of recipients
     *
     * @var Recipients
     */
    public $recipients;

    public function loadFromStdclass(\stdClass $object): self
    {
        parent::loadFromStdclass($object);

        $this->recipients = new Recipients();
        $this->recipients->messageId = $object->id;
        $this->recipients ->loadFromStdclass($object->recipients);
        $this->typeDetails = get_object_vars($object->typeDetails);

        return $this;
    }
}