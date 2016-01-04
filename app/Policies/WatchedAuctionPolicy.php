<?php

namespace App\Policies;

use App\Models\WatchedAuction;
use App\Models\User;

class WatchedAuctionPolicy
{
    public function delete(User $user, WatchedAuction $watchedAuction)
    {
        return $user->id === $watchedAuction->user_id;
    }

    public function update(User $user, WatchedAuction $watchedAuction)
    {
        return $user->id === $watchedAuction->user_id;
    }
}