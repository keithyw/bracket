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
        //$this->app->bind('App\Services\GoogleSearchInterface', 'App\Services\GoogleSearch');
        $this->app->bind('App\Services\GiphySearchInterface', 'App\Services\GiphySearch');
        $this->app->bind('App\Services\GoogleGeocodingSearchInterface', 'App\Services\GoogleGeocodingSearch');
        $this->app->bind('App\Services\YoutubeSearchInterface', 'App\Services\YoutubeSearch');
    }
}