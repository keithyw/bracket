<?php

namespace App\Http\Controllers\Admin;

use Conark\Jackhammer\Http\Controllers\BaseCoreResourceController;
use App\Repositories\WatchedAuctionRepositoryInterface;
use App\Models\WatchedAuction;
use App\Policies\WatchedAuctionPolicy;

class WatchedAuctionController extends BaseCoreResourceController
{


    public function __construct(WatchedAuctionRepositoryInterface $watchedAuctionRepositoryInterface)
    {
        $this->repository = $watchedAuctionRepositoryInterface;
    }

    protected function getModel()
    {
        if (!$this->model){
            $this->model = new WatchedAuction();
        }
        return $this->model;
    }

    protected function getPolicy()
    {
        if (!$this->policy){
            $this->policy = new WatchedAuctionPolicy();
        }
        return $this->policy;
    }

    protected function getResourceDirectory()
    {
        return 'watched_auction';
    }

    protected function getBaseRoute()
    {
        return 'admin.watched-auctions';
    }


}