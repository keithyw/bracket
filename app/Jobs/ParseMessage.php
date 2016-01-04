<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 2:47 PM
 */

namespace App\Jobs;

use Event;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Events\ProcessLinkEvent;
use App\Models\RawMessage;
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
        foreach ($this->_elements as $ele){
            if (preg_match_all($ele['reg'], $this->_message, $matches)){
                Event::fire(new ProcessLinkEvent($this->_user, $ele['type'], $matches[1]));
            }
        }

        return true;
    }
}