<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/12/16
 * Time: 7:24 PM
 */

class InstagramSearchTest extends TestCase {
    protected $_service;

    public function setUp(){
        parent::setUp();
        $this->_service = $this->app->make("App\Services\InstagramSearchInterface");
    }

    public function testSearch(){
        $term = 'snow';
        $results = $this->_service->search($term);
    }
}