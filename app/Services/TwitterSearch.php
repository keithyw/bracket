<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/12/16
 * Time: 1:56 AM
 */

namespace App\Services;

use Config;
use Conark\ServiceWrapper\Services\BaseRemoteCallService;

class TwitterSearch extends BaseRemoteCallService implements TwitterSearchInterface{

    /**
     * @var string
     */
    private $_url = 'https://api.twitter.com/1.1/search/tweets.json';

    /**
     * @var string
     */
    private $_requestTokenUrl = 'https://api.twitter.com/oauth2/token';

    /**
     * @var string
     */
    private $_authorizeUrl = 'https://api.twitter.com/oauth/authorize';

    /**
     * @var string
     */
    private $_accessTokenUrl = 'https://api.twitter.com/oauth/access_token';

    /**
     * @var string
     */
    private $_callbackUrl = 'http://testing.dev/twitter-api';


    //https://api.twitter.com/1.1/search/tweets.json?q=%23freebandnames&since_id=24012619984051000&max_id=250126199840518145&result_type=mixed&count=4
    /**
     * @param string $term
     * @return array
     */
    public function search($term)
    {
        $bearerTokenCredentials = Config::get('services.twitter.consumer_key') . ":" . Config::get('services.twitter.consumer_secret');
        $encodedBearerTokenCredentials = base64_encode($bearerTokenCredentials);
        $data = 'grant_type=client_credentials';
        $opts = ['http' => [
            'method' => 'POST',
            'header' => "Authorization: Basic {$encodedBearerTokenCredentials}\r\n"
                        . "Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n",
            'content' => $data
        ]];
        ini_set('default_socket_timeout', 120);
        $context = stream_context_create($opts);
        $contents = file_get_contents($this->_requestTokenUrl ,null, $context);
        $response = json_decode($contents);
        // now we have an access token
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => "Authorization: Bearer {$response->access_token}\r\n"
            ]
        ];
        $context = stream_context_create($opts);
        $url = "{$this->_url}?q=" . urlencode($term);
        return json_decode(file_get_contents($url, null, $context), true);
    }

}