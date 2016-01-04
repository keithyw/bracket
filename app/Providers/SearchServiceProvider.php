<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 7:29 PM
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider{
    public function register()
    {
        $this->app->bind('App\Services\YoutubeSearchInterface', 'App\Services\YoutubeSearch');
        //$this->app->bind('App\Repositories\AddressRepositoryInterface', 'App\Repositories\AddressRepository');
    }
}