<?php

namespace App\Repositories\SMS;

use MessageBird\Objects\Base;

class SmsPrice extends Base
{
    public ?float $amount;
    public ?string $currency;
}