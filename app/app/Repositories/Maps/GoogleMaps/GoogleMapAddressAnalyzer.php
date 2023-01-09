<?php

namespace App\Repositories\Maps\GoogleMaps;

use App\Repositories\ApiInvoker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * requires GOOGLE_MAP_GEOCODE_KEY
 */
class GoogleMapAddressAnalyzer extends ApiInvoker
{

    /**
     * @var \stdClass|null
     */
    private ?\stdClass $result;

    private ?GoogleAddressComponent $address_component;

    private ?string $formatted_address;

    /**
     * GoogleMapAddressAnalyzer constructor.
     * @param string $address
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct( string $address )
    {
        $this->loadAddress($address);
    }

    /**
     * @return string|null
     */
    public function getFormattedAddress(): ?string
    {
        return $this->formatted_address;
    }

    /**
     * @param $address
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function loadAddress($address): void
    {
        $this->queryStringRequest("maps/api/geocode/json", [
            "address" => $address,
            "key" => env("GOOGLE_MAP_API_KEY"),
        ]);

        $this->formatted_address = null;

        if ($this->getData()->status === 'OK') {

            $this->result = (object) Arr::first( $this->getData()->results );
            $this->address_component = new GoogleAddressComponent( $this->result);

            $this->formatted_address = $this->result->formatted_address;
        }
    }

    /**
     * @inheritDoc
     */
    protected function toUrl(string $link): string
    {
        return Str::of("https://maps.googleapis.com/"  )->rtrim('/')
            . Str::of( $link )->start("/" );
    }

    /**
     * @return \stdClass|null
     */
    public function getAddressAnalyzed(): ?\stdClass
    {
        return $this->result;
    }

    /**
     * @return GoogleAddressComponent|null
     */
    public function getAddressComponent(): ?GoogleAddressComponent
    {
        return $this->address_component;
    }
}
