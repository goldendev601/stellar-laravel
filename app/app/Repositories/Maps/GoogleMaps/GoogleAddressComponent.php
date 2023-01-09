<?php

namespace App\Repositories\Maps\GoogleMaps;

class GoogleAddressComponent
{
    /**
     * @var string
     */
    private $formatted_address;
    /**
     * @var string
     */
    private $postal_code;
    /**
     * @var string
     */
    private  $country;

    /**
     * @var string
     */
    private  $state;

    /**
     * @var \stdClass|null
     */
    private ?\stdClass $state_component;

    /**
     * @var array|null
     */
    private ?array $address_components;

    /**
     * @var string
     */
    private  $street;

    /**
     * @var ?string
     */
    private ?string $province;

    private ?float $lat;

    private ?float $lng;


    /**
     * Address Data
     * @param \stdClass|null $data
     */
    public function __construct(?\stdClass $data )
    {
        $geometry = (object)((object)$data->geometry)->location;

        // ensure this is fully array
        $this->address_components = json_decode(json_encode($data->address_components), true);

        $this->lat = optional($geometry)->lat;
        $this->lng = optional($geometry)->lng;

        $locality_component = $this->fetchAddressComponent($this->address_components, "locality");
        $this->state_component = $this->fetchAddressComponent($this->address_components, "administrative_area_level_1");
        $country_component = $this->fetchAddressComponent($this->address_components, "country");
        $postal_component = $this->fetchAddressComponent($this->address_components, "postal_code");

        $this->formatted_address = $data->formatted_address;
        $this->postal_code = $postal_component ? $postal_component->long_name : null;
        $this->country = $country_component ? $country_component->long_name : null;
        $this->province = $locality_component ? $locality_component->long_name : null;
        $this->state = $this->state_component?->long_name;
        $this->street = $this->postal_code ? trim(substr($this->formatted_address, 0, strpos($this->formatted_address, $this->postal_code)), ", ") : null;


    }


    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }


    /**
     * @return string
     */
    public function getFormattedAddress()
    {
        return $this->formatted_address;
    }


    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }


    public function getProvince()
    {
        return $this->province;
    }

    public function getState()
    {
        return $this->state;
    }

    /**
     * @return object|\stdClass|null
     */
    public function getStateComponent()
    {
        return $this->state_component;
    }

    /**
     * @return float|   null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param array $address_components
     * @param string $key
     * @return object|null
     */
    private function fetchAddressComponent(array $address_components, string $key)
    {
        if( $address_components == null || !is_array( $address_components ) || !$key ) return null;

        $component = array_filter( $address_components, function ( $item ) use($key){
                         return array_key_exists("types", $item ) && collect( $item[ "types" ])->contains( $key );
        } );

        return count( $component ) == 1 ? (object) collect($component)->first() : null ;
    }
}
