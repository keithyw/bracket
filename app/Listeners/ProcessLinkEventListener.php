<?php

namespace App\Listeners;

use Config;
use Pusher;
use App\Events\ProcessLinkEvent;
use App\Models\RawResult;
use App\Services\YoutubeSearchInterface;
use App\Services\YoutubeServiceInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessLinkEventListener
{
    /**
     * @var Pusher
     */
    private $_pusher;

    /**
     * @var YoutubeServiceInterface
     */
    private $_youtubeService;

    /**
     * @param YoutubeSearchInterface $youtubeSearchInterface
     */
    public function __construct(YoutubeSearchInterface $youtubeSearchInterface)
    {
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
            $data = $this->_youtubeService->search($term);
            $obj = new RawResult();
            $obj->fill(['type' => $event->type, 'term' => $term, 'results' => json_encode($data)]);
            $obj->save();
        }
        $this->_pusher->trigger('message_channel', 'process_link', $data);
    }
}
