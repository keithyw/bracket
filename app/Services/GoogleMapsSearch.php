<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/7/16
 * Time: 11:07 PM
 */

namespace App\Services;

use Google_Client;
use Google_Service_MapsEngine;


class GoogleMapsSearch implements GoogleMapsSearchInterface {

    /**
     * @param string $term
     * @return array
     */
    public function search($term)
    {
        $client = new Google_Client();
        $client->setDeveloperKey(Config::get('services.youtube'));
        $engine = new Google_Service_MapsEngine($client);
    }
}