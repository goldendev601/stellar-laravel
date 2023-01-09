<?php

namespace App\Repositories\Maps\GoogleMaps;

use Illuminate\Support\Facades\Log;

class GoogleMapGeoAddressAnalyzer
{
    /**
     * @var bool
     */
    private $success = false;

    private ?GoogleAddressComponent $address_component;

    /**
     * GoogleMapAddressAnalyzer constructor.
     * @param $latitude float
     * @param $longitude float
     */
    public function __construct( $latitude, $longitude )
    {

        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=" . env( "GOOGLE_MAP_API_KEY" );

        $result = json_decode( @file_get_contents($url), true);

        $this->success = isset( $result['status'] ) && $result['status'] == 'OK';

        if ( $this->success ) {

            try{

               $data = (object) $result["results"][0];
               $this->address_component = new GoogleAddressComponent( $data );

            }catch(\Exception $exception){
                Log::info( "Error Reading Google Map Analyzer Result! Please, confirm to be sure the format is not different!" ,
                    [
                        "error" => $exception->getMessage(),
                        "data" => json_encode( $result )
                    ]);
            }
        }
    }

    /**
     * @return GoogleAddressComponent|null
     */
    public function getAddressComponent(): ?GoogleAddressComponent
    {
        return $this->address_component;
    }
}
