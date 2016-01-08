<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/7/16
 * Time: 11:24 PM
 */

use App\Services\GoogleGeocodingSearchInterface;

class GoogleGeocodingSearchTest extends TestCase {
    protected $_serviceName;
    protected $_service;

    public function setUp(){
        parent::setUp();
        $this->_service = $this->app->make("App\Services\GoogleGeocodingSearchInterface");
    }

    public function testSearch(){
        $address = 'blah blah blah';
        $this->_service->search($address);
    }
}