<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/7/16
 * Time: 11:18 PM
 */

namespace App\Services;

use Config;
use Conark\ServiceWrapper\Services\BaseRemoteCallService;

class GoogleGeocodingSearch extends BaseRemoteCallService implements GoogleGeocodingSearchInterface {

    //private $_url = 'https://maps.googleapis.com/maps/api/geocode/output?parameters';
    private $_url = 'https://maps.googleapis.com/maps/api/geocode/json?';
    /**
     * @param string $address
     * @return array
     */
    public function search($address)
    {
        $params = ['address' => urlencode($address), 'key' => Config::get('services.youtube')];
        $url = $this->_url . join('&', array_map(function($key) use ($params){
            return "{$key}={$params[$key]}";
        }, array_keys($params)));
        $response = $this->makeCall($url);
        if (200 == $response->getStatusCode()){
            $data = $response->json();
            return $data['results'];
        }
        return null;
    }
}