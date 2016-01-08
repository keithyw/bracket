<?php

namespace App\Listeners;

use Config;
use Pusher;
use App\Events\ProcessLinkEvent;
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
        foreach ($event->items as $term){
            $term = trim($term);
            // this part we can call a separate function to defer
            // the specific search
            $data = null;
            switch ($event->type){
                case 'link':
                    $data = $this->_youtubeService->search($term);
                    break;
                case 'map':
                    $data = $this->_googleGeocodingSearch->search($term);
                    break;
            }

            $obj = new RawResult();
            $obj->fill(['type' => $event->type, 'term' => $term, 'results' => json_encode($data)]);
            $obj->save();
        }
        //$this->_pusher->trigger('message_channel', 'process_link', $data);
    }
}
