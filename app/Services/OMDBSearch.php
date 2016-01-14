<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/13/16
 * Time: 3:16 PM
 */

namespace App\Services;

use Config;
use Conark\ServiceWrapper\Services\BaseRemoteCallService;

class OMDBSearch extends BaseRemoteCallService implements OMDBSearchInterface {
    private $_url = 'http://www.omdbapi.com/?';
    /**
     * @param string $term
     * @return array
     */
    public function search($term)
    {
        $term = urlencode($term);
        $params = ['s' => urlencode($term), 'r' => 'json'];
        $url = $this->_url . join('&', array_map(function($key) use ($params){
                return "{$key}={$params[$key]}";
            }, array_keys($params)));
        $response = $this->makeCall($url);
        if (200 == $response->getStatusCode()){
            $data = $response->json();
            return $data['Search'];
        }
        return null;
    }

}