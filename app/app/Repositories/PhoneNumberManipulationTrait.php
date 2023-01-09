<?php

namespace App\Repositories;

use Illuminate\Support\Str;

trait PhoneNumberManipulationTrait
{
    /**
     * @param string $phone
     * @return string
     */
    public static function phoneToMsisdn(string $phone): string
    {
        return (string)Str::of(self::cleanUpPhoneNumber( $phone ))->replace("+", "");
    }

    /**
     * @param string $to
     * @return string
     */
    public static function cleanUpPhoneNumber(string $to): string
    {
        return "+" . preg_replace('/[^0-9_]/', '', $to );
    }
}
