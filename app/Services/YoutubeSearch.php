<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 8:35 PM
 */

namespace App\Services;

use Config;
use Google_Client;
use Google_Service_YouTube;

class YoutubeSearch implements YoutubeSearchInterface {
    /**
     * @param string $term
     * @return array
     */
    public function search($term)
    {
        $client = new Google_Client();
        $client->setDeveloperKey(Config::get('services.youtube'));
        $youtube = new Google_Service_YouTube($client);
        $results = $youtube->search->listSearch('id,snippet', ['q' => $term, 'maxResults' => 10]);
        $arr = [];
        foreach ($results as $i){
            $thumb = $i['snippet']['thumbnails'];
            $arr[]= [
                'id' => $i['id']['videoId'],
                'image_default' => $thumb->getDefault()->getUrl(),
                'image_medium' => $thumb->getMedium()->getUrl(),
                'image_high' => $thumb->getHigh()->getUrl(),
                'title' => $i['snippet']['title'],
                'description' => $i['snippet']['description'],
                'channel_id' => $i['snippet']['channelId'],
                'channel_title' => $i['snippet']['channelTitle']
            ];
        }
        return $arr;
    }
}