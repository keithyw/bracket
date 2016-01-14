<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/13/16
 * Time: 3:23 PM
 */

class OMDBSearchTest extends TestCase{
    protected $_service;

    public function setUp(){
        parent::setUp();
        $this->_service = $this->app->make("App\Services\OMDBSearchInterface");
    }

    public function testSearch(){
        $term = 'the black hole';
        $results = $this->_service->search($term);
        print_r($results);
    }
}