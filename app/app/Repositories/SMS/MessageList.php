<?php

namespace App\Repositories\SMS;

class MessageList extends \MessageBird\Objects\BaseList
{
    /**
     * @var Message[]
     */
    public $items;
}