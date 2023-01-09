<?php

namespace App\Repositories\SMS;

use MessageBird\Common\HttpClient;

class Client extends \MessageBird\Client
{
    /**
     * @var Messages
     */
    public $messages;

    public function __construct(?string $accessKey = null, HttpClient $httpClient = null, array $config = [])
    {
        parent::__construct($accessKey, $httpClient, $config);
        $this->messages = new Messages($this->httpClient);
    }

}