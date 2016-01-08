<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/7/16
 * Time: 7:29 PM
 */

namespace App\Services;

use Config;
use Google_Client;
use Google_Service_Customsearch;



class GoogleSearch implements GoogleSearchInterface{
    /**
     * @param string $term
     * @return array
     */
    public function search($term){
        $client = new Google_Client();
        $client->setDeveloperKey(Config::get('services.youtube'));
        $service = new Google_Service_Customsearch($client);
        //$youtube = new Google_Service_YouTube($client);
        //$results = $youtube->search->listSearch('id,snippet', ['q' => $term, 'maxResults' => 10]);
    }
}