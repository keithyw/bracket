<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/11/16
 * Time: 3:57 PM
 */

namespace App\Services;

use Config;
use Conark\ServiceWrapper\Services\BaseRemoteCallService;

class GiphySearch extends BaseRemoteCallService implements GiphySearchInterface{

    private $_url = 'http://api.giphy.com/v1/gifs/search?';
    /**
     * @param string $term
     * @return array
     */
    public function search($term)
    {
        $params = ['q' => urlencode($term), 'api_key' => Config::get('services.giphy'), 'limit' => 3];
        $url = $this->_url . join('&', array_map(function($key) use ($params){
                return "{$key}={$params[$key]}";
            }, array_keys($params)));
        $response = $this->makeCall($url);
        if (200 == $response->getStatusCode()){
            $data = $response->json();
            return $data['data'];
        }
        return null;
    }

}