<?php

namespace App\ModelsExtended;

class MemberInterest extends \App\Models\MemberInterest
{
    /**
     * You can use for auto suggest
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getUniqueInterest()
    {
        return self::query()->select('interest')->distinct();
    }
}