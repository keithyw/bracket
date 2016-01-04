<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProcessLinkEvent extends Event
{
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $items;

    /**
     * @param User $user
     * @param string $type
     * @param array $items
     */
    public function __construct(User $user, $type, $items)
    {
        $this->user = $user;
        $this->type = $type;
        $this->items = $items;
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
