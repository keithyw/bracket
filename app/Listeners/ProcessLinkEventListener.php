<?php

namespace App\Listeners;

use Config;
use Log;
use Pusher;
use App\Events\ProcessLinkEvent;
use App\Models\ProcessedMessage;
use App\Models\RawResult;
use App\Services\GiphySearchInterface;
use App\Services\GoogleGeocodingSearchInterface;
use App\Services\InstagramSearchInterface;
use App\Services\OMDBSearchInterface;
use App\Services\TwitterSearchInterface;
use App\Services\YoutubeSearchInterface;
use App\Services\YoutubeServiceInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessLinkEventListener
{

    /**
     * @var GiphySearchInterface
     */
    private $_giphySearch;

    /**
     * @var GoogleGeocodingSearchInterface
     */
    private $_googleGeocodingSearch;

    /**
     * @var InstagramSearchInterface
     */
    private $_instagramSearch;

    /**
     * @var OMDBSearchInterface
     */
    private $_omdbSearch;

    /**
     * @var Pusher
     */
    private $_pusher;

    /**
     * @var TwitterSearchInterface
     */
    private $_twitterSearch;

    /**
     * @var YoutubeSearchInterface
     */
    private $_youtubeService;

    /**
     * @param GiphySearchInterface $giphySearchInterface
     * @param GoogleGeocodingSearchInterface $googleGeocodingSearchInterface
     * @param InstagramSearchInterface $instagramSearchInterface
     * @param OMDBSearchInterface $omdbSearchInterface
     * @param TwitterSearchInterface $twitterSearchInterface
     * @param YoutubeSearchInterface $youtubeSearchInterface
     */
    public function __construct(GiphySearchInterface $giphySearchInterface,
                GoogleGeocodingSearchInterface $googleGeocodingSearchInterface,
                InstagramSearchInterface $instagramSearchInterface,
                OMDBSearchInterface $omdbSearchInterface,
                TwitterSearchInterface $twitterSearchInterface,
                YoutubeSearchInterface $youtubeSearchInterface)
    {
        $this->_giphySearch = $giphySearchInterface;
        $this->_googleGeocodingSearch = $googleGeocodingSearchInterface;
        $this->_instagramSearch = $instagramSearchInterface;
        $this->_omdbSearch = $omdbSearchInterface;
        $this->_pusher = new Pusher(Config::get('services.pusher.key'), Config::get('services.pusher.secret'), Config::get('services.pusher.app_id'));
        $this->_twitterSearch = $twitterSearchInterface;
        $this->_youtubeService = $youtubeSearchInterface;
    }

    private function _processGiphy($results)
    {
        $arr = [];
        foreach ($results as $res){
            $arr[]= $res['images']['original'];
        }
        return $arr;
    }

    private function _processInstagram($term)
    {
        $results = $this->_instagramSearch->search($term);
        $arr = [];
        foreach ($results as $res){
            $image = $res['images']['standard_resolution'];
            $arr[]= ['image' => $image, 'url' => $res['link']];
        }
        return $arr;
    }


    /**
     *

    $url = 'http://example.com/image.php';
    $img = '/my/folder/flower.gif';
    file_put_contents($img, file_get_contents($url));
     */
    private function _processOMDB($term)
    {
        $results = $this->_omdbSearch->search($term);
        $arr = [];
        Log::info($results);
        foreach ($results as &$res){
            if (isset($res['Poster']) && $res['Poster'] != 'N/A'){
                $img = '/images/' . md5($res['Poster']) . '.jpg';
                $name = public_path($img);
                $image = file_get_contents($res['Poster']);
                file_put_contents($name, $image);
                $res['image'] = $img;
                $arr[] = $res;
            }
        }
        return $arr;
    }

    private function _processTwitch($channel)
    {
        return $channel;
    }
    /**
     * @param string $term
     */
    private function _processTwitter($term)
    {
        $results = $this->_twitterSearch->search($term);
        $arr = [];
        if (isset($results['statuses'])){
            foreach ($results['statuses'] as $tweet){
                $arr[]= ['id' => $tweet['id_str'], 'user' => $tweet['user']['screen_name'], 'text' => $tweet['text']];
            }
        }
        return $arr;
    }

    /**
     * Handle the event.
     *
     * @param  ProcessLinkEvent  $event
     * @return void
     */
    public function handle(ProcessLinkEvent $event)
    {
        // do we still need to process each item term by term?
        $term = trim($event->term);
        // this part we can call a separate function to defer
        // the specific search
        $data = [];
        switch ($event->type){
            case 'giphy':
                $data = $this->_processGiphy($this->_giphySearch->search($term));
                break;
            case 'instagram':
                $data = $this->_processInstagram($term);
                break;
            case 'movie':
                $data = $this->_processOMDB($term);
                break;
            case 'twitch':
                $data = $this->_processTwitch($term);
                break;
            case 'twitter':
                $data = $this->_processTwitter($term);
                break;
            case 'video':
                $data = $this->_youtubeService->search($term);
                break;
            case 'map':
                $data = $this->_googleGeocodingSearch->search($term);
                break;
        }

        $obj = new RawResult();
        $obj->fill(['type' => $event->type, 'term' => $term, 'results' => json_encode($data)]);
        $obj->save();

        // next have to deserialize the raw results and append these new results
        // to them
        // may not always have one

        // exception occurs because property not accessible. happens when there are no processed Messages


        $processedMessage = ProcessedMessage::where('raw_message_id', '=', $event->rawMessage->id)->first();
        if (isset($processedMessage->id)){
            $processedMessage = $event->rawMessage->processedMessage;
            $processedMessage->message = str_replace($event->replacedItem, $this->_convertBracket($obj->id), $processedMessage->message);
        }
        else{
            $processedMessage = new ProcessedMessage();
            // doesn't quite work because processedMessage->message is blank
            //$newMessage = str_replace($matches[0][$x], $this->_convertBracket($ele['type'], $term, $item), $newMessage);
            $processedMessage->message = str_replace($event->replacedItem, $this->_convertBracket($obj->id), $event->rawMessage->message);
            $processedMessage->rawMessage()->associate($event->rawMessage);
        }
        $data = json_decode($processedMessage->raw_results, true);
        $data[$obj->id] = $obj;
        $processedMessage->raw_results = json_encode($data);
        $processedMessage->save();
        Log::info("sending to pusher");
        Log::info("message " . print_r($processedMessage->message, 1));
        Log::info("raw_results " . print_r($data, 1));
        foreach ($data as $id => &$arr){
            $arr['results'] = json_decode($arr['results'], 1);
        }
        $processedMessage->raw_results = $data;
        $this->_pusher->trigger('message_channel', 'process_link', $processedMessage);
    }

    /**
     * @param int $id
     * @return string
     */
    private function _convertBracket($id){
        return "|{$id}|";
    }
}
