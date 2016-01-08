<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 2:47 PM
 */

namespace App\Jobs;

use Event;
use Log;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Events\ProcessLinkEvent;
use App\Models\ProcessedMessage;
use App\Models\RawMessage;
use App\Models\RawResult;
use App\Models\User;

class ParseMessage extends Job implements SelfHandling{

    /**
     * @var string
     */
    private $_message;

    /**
     * @var User
     */
    private $_user;

    /**
     * @var array
     */
    private $_elements = [
        ['reg' => '/\[l(.*?)l\]/', 'type' => 'link'],
        ['reg' => '/\[i(.*?)i\]/', 'type' => 'image'],
        ['reg' => '/\[map(.*?)map\]/', 'type' => 'map'],
        ['reg' => '/\[g(.*?)g\]/', 'type' => 'giphy'],
        ['reg' => '/\[p(.*?)p\]/', 'type' => 'preview'],
        ['reg' => '/\[t(.*?)t\]/', 'type' => 'twitter'],
        ['reg' => '/\[v(.*?)v\]/', 'type' => 'video'],

    ];

    /**
     * @param User $user
     * @param string $message
     */
    public function __construct(User $user, $message)
    {
        $this->_user = $user;
        $this->_message = $message;
    }

    /**
     * Let's start with a few basic things to parse
     * [l l] -> search link
     * [i i] -> image
     * [map map] -> map search
     * [g g] -> animated gif
     * [p p] -> preview
     * [v v] -> video
     * [t t] -> twitter
     *
     * First extract these elements
     * store them
     * push them off into a queue to be further processed
     *
     * create second message that converts the original message into
     * an html version of the message
     *
     * on the front end as the items are processed, the html elements
     * get replaced with the returned results
     *
     * processed result is converted into a component. might be a multi-stage
     * component with raw result and a processed saved result
     *
     * if result > 1, then we store a result set. User can scroll through the result
     * set and choose the thing that best expresses his intent
     *
     * store the original message as well
     *
     * @return bool
     */
    public function handle()
    {
        $raw = new RawMessage();
        $raw->fill(['message' => $this->_message]);
        $raw->user()->associate($this->_user);
        $raw->save();
        $data = [];
        // need to convert term + type into the results
        // convert the [] into usable tags

        // we'll use this as a starting template and then replace each of the []
        // into tags.
        $newMessage = $this->_message;
        foreach ($this->_elements as $ele){
            if (preg_match_all($ele['reg'], $this->_message, $matches)){
                // $matches[0] contains the entire matching item
                $x = 0;
                foreach ($matches[1] as $term){
                    $term = trim($term);
                    Log::info("term " . $term);
                    // should cache the results
                    // found the result. now we need to find the [] and replace it.
                    // maybe use some kind of custom tag or perhaps a React Component
                    // that gets rendered?
                    // either way, we probably want to include the raw_results id to display a list of
                    // related items.
                    $item = RawResult::whereRaw('type = ? AND term = ?', [$ele['type'], $term])->first();
                    if (isset($item->id)){
                        //$arr = json_decode($item->results);
                        Log::info($item);
                        Log::info($matches);
                        $item->results = json_decode($item->results);
                        $data[$item->id]= $item;
                        $newMessage = str_replace($matches[0][$x], $this->_convertBracket($ele['type'], $term, $item), $newMessage);

                    }
                    else{
                        // put the actual term search into a background type of call
                        Event::fire(new ProcessLinkEvent($this->_user, $ele['type'], $matches[1]));
                    }
                    $x++;
                }

            }
        }
        $processedMessage = new ProcessedMessage();
        $processedMessage->fill(['message' => $newMessage, 'raw_results' => json_encode($data)]);
        $processedMessage->rawMessage()->associate($raw);
        $processedMessage->save();

        // save to processed message?
        return ['message' => $newMessage, 'raw_results' => $data];
        //return true;
    }

    /**
     * convert [] into an html tag
     *
     * @param string $type
     * @param string $term
     * @param RawResult $item
     * @return string
     */
    private function _convertBracket($type, $term, RawResult $item){
        $tag = 'span';
        //$tag = 'raw-result';

        /**
         * we'll expand on this later
        switch ($type){
            case 'link':
            case 'image':
            case 'giphy':
            case 'preview':
            case 'twitter':
            case 'video':
        }
         */
        return "|{$item->id}|";
        //return "<{$tag} data-result-id=\"{$item->id}\" data-result-type=\"{$type}\">{$term}</{$tag}>";
    }
}

/**
['reg' => '/\[l(.*?)l\]/', 'type' => 'link'],
        ['reg' => '/\[i(.*?)i\]/', 'type' => 'image'],
        ['reg' => '/\[g(.*?)g\]/', 'type' => 'giphy'],
        ['reg' => '/\[p(.*?)p\]/', 'type' => 'preview'],
        ['reg' => '/\[t(.*?)t\]/', 'type' => 'twitter'],
        ['reg' => '/\[v(.*?)v\]/', 'type' => 'video'],*/