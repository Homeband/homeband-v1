<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 18-12-17
 * Time: 21:17
 */

class Google_geo_model extends CI_Model
{
    private $api_key = "AIzaSyCbfgsxguI6tfXCS4-yyxe7y9wVGpZZGTs";

    public function __construct()
    {
        parent::__construct();

    }

    public function getGeocoding($address = ""){

        $this->rest->initialize(array('server' => 'https://maps.googleapis.com/maps/api/geocode/'));

        $params = array(
            "address" => $address,
            "key" => $this->api_key
        );

        $resultats = $this->rest->get("json", $params);

        if(isset($resultats) && !empty($resultats) && $resultats->status === "OK"){
            $coord = $resultats->results[0]->geometry->location;
            $retour = array(
                'lat' => (double)$coord->lat,
                'lon' => (double)$coord->lng
            );
        } else {
            $retour = array(
                'lat' => 0.0,
                'lon' => 0.0
            );
        }

        return $retour;
    }
}