<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/12/16
 * Time: 7:13 PM
 */

namespace App\Services;

use Config;
use Conark\ServiceWrapper\Services\BaseRemoteCallService;

class InstagramSearch extends BaseRemoteCallService implements InstagramSearchInterface{

    //https://api.instagram.com/v1/tags/search?q=snowy&access_token=1387227136.f46f6ef.bb7462e1ede84e58bfe323666467fa7f
    //https://api.instagram.com/v1/tags/latergram/media/recent?

    private $_url = 'https://api.instagram.com/v1/tags';
    /**
     * @param string $term
     * @return array
     */
    public function search($term)
    {
        $term = urlencode($term);
        $url = "{$this->_url}/{$term}/media/recent?access_token=" . Config::get('services.instagram.access_token');
        $response = $this->makeCall($url);
        if (200 == $response->getStatusCode()){
            $data = $response->json();
            return $data['data'];
        }
        return null;

    }

}