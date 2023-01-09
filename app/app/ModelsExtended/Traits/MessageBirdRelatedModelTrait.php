<?php

namespace App\ModelsExtended\Traits;

use App\ModelsExtended\ContactGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait MessageBirdRelatedModelTrait
{
    /**
     * @param string $message_bird_id
     * @return Builder|Model|object|null
     */
    public static function getByMessageBirdId(string $message_bird_id)
    {
        return self::query()->where('message_bird_id', $message_bird_id)->first();
    }
}