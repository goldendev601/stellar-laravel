<?php

namespace App\Repositories\Bitly;

use App\Exceptions\APIInvocationException;
use App\Repositories\ApiInvoker;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

/**
 * https://dev.bitly.com/api-reference
 */
class ApiRequests extends ApiInvoker
{
    public function __construct()
    {
        $this->access_token = env("BITLY_ACCESS_TOKEN");
    }

    /**
     * @inheritDoc
     */
    protected function toUrl(string $link): string
    {
        return Str::of( "https://api-ssl.bitly.com/v4"  )->rtrim('/')
            . Str::of( $link )->start("/" );
    }

    /**
     * @return $this
     * @throws APIInvocationException
     * @throws GuzzleException
     */
    public function groups(): static
    {
            if (!$this->queryStringRequest('groups', [
                "organization_guid" => env("BITLY_ORGANIZATION_GUID"),
            ] )) $this->throwException();

        // return the model here
        return $this;
    }

    /**
     * Sample stdClass from getData()
        ^ {#515 ▼
          +"created_at": "2022-11-09T11:23:31+0000"
          +"id": "stllr.me/3G21aH4"
          +"link": "https://stllr.me/3G21aH4"
          +"custom_bitlinks": []
          +"long_url": "https://github.com/Beyondimagine/stellar"
          +"archived": false
          +"tags": []
          +"deeplinks": []
          +"references": {#513 ▼
            +"group": "https://api-ssl.bitly.com/v4/groups/Bm2ffdhWIT3"
          }
        }
     *
     * @param string $long_url
     * @return $this
     * @throws APIInvocationException
     * @throws GuzzleException
     */
    public function shortenUrl( string $long_url ): ApiRequests
    {
        if (!$this->jsonRequest('shorten', [
            "long_url" => $long_url,
            "domain" => env("BITLY_CUSTOM_DOMAIN"),
            "group_guid" => env("BITLY_GROUP_GUID"),
        ], 'POST' )) $this->throwException();

        // return the model here
        return $this;
    }

    /**
     * https://dev.bitly.com/api-reference/#updateBitlink
     *   +"id": "stllr.me/3G21aH4"
     *
     * @param string $id
     * @param string $long_url
     * @return $this
     * @throws APIInvocationException
     * @throws GuzzleException
     */
    public function updateShortenedUrl(string $id, string $long_url ): ApiRequests
    {
        if (!$this->jsonRequest("bitlinks/$id", [
            "long_url" => $long_url, // this is not changing after creation
            "title" => $long_url,
        ], 'PATCH' )) $this->throwException();

        // return the model here
        return $this;
    }

    /**
     * https://dev.bitly.com/api-reference/#deleteBitlink
     *   +"id": "stllr.me/3G21aH4"
     *
     * @param string $id
     * @return $this
     * @throws APIInvocationException
     * @throws GuzzleException
     */
    public function deleteShortenedUrl(string $id ): ApiRequests
    {
        if (!$this->jsonRequest("bitlinks/$id", [], 'DELETE' )) $this->throwException();

        // return the model here
        return $this;
    }
}
