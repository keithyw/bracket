<?php

namespace App\Listeners;

use Config;
use Log;
use Pusher;
use App\Events\ProcessLinkEvent;
use App\Models\ProcessedMessage;
use App\Models\RawResult;
use App\Services\GoogleGeocodingSearchInterface;
use App\Services\YoutubeSearchInterface;
use App\Services\YoutubeServiceInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessLinkEventListener
{

    /**
     * @var GoogleGeocodingSearch
     */
    private $_googleGeocodingSearch;

    /**
     * @var Pusher
     */
    private $_pusher;

    /**
     * @var YoutubeServiceInterface
     */
    private $_youtubeService;

    /**
     * @param GoogleGeocodingSearchInterface $googleGeocodingSearchInterface
     * @param YoutubeSearchInterface $youtubeSearchInterface
     */
    public function __construct(GoogleGeocodingSearchInterface $googleGeocodingSearchInterface, YoutubeSearchInterface $youtubeSearchInterface)
    {
        $this->_googleGeocodingSearch = $googleGeocodingSearchInterface;
        $this->_pusher = new Pusher(Config::get('services.pusher.key'), Config::get('services.pusher.secret'), Config::get('services.pusher.app_id'));
        $this->_youtubeService = $youtubeSearchInterface;
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
        //$this->_pusher->trigger('message_channel', 'process_link', ['message' => $processedMessage]);

        // unfortunate but necessary

        foreach ($data as $id => &$arr){
            $arr['results'] = json_decode($arr['results'], 1);
        }
        $processedMessage->raw_results = $data;
        $this->_pusher->trigger('message_channel', 'process_link', $processedMessage);
        //return ['message' => $newMessage, 'raw_results' => $data];
        //$this->_pusher->trigger('message_channel', 'process_link', $data);
    }

    /**
     * @param int $id
     * @return string
     */
    private function _convertBracket($id){
        return "|{$id}|";
    }
}
