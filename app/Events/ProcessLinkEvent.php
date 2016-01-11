<?php

namespace App\Events;

use App\Events\Event;
use App\Models\RawMessage;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProcessLinkEvent extends Event
{
    use SerializesModels;

    /**
     * @var RawMessage
     */
    public $rawMessage;

    /**
     * @var string
     */
    public $replacedItem;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $term;

    /**
     * @var string
     */
    public $type;

    /**
     * @param User $user
     * @param string $type
     * @param string $term
     * @param RawMessage $raw
     * @param string $replaceItem
     */
    public function __construct(User $user, $type, $term, RawMessage $raw, $replaceItem)
    {
        $this->user = $user;
        $this->type = $type;
        $this->term = $term;
        $this->rawMessage = $raw;
        $this->replacedItem = $replaceItem;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
