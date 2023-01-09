<?php

namespace App\Repositories\SMS;

class Recipient extends \MessageBird\Objects\Recipient
{
    /**
     * @var SmsPrice|null|\stdClass $price
     */
    public \stdClass|SmsPrice|null $price;

    /**
     * @var string
     */
    public string $messageId;

    /**
     * @param \stdClass $object
     * @return self
     */
    public function loadFromStdclass(\stdClass $object): self
    {
        parent::loadFromStdclass($object);

        if (!empty($this->price)) {
            $p = new SmsPrice();
            $this->price = $p->loadFromStdclass($this->price);
        }

        return $this;
    }
}