<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/11/16
 * Time: 4:58 PM
 */

class GiphySearchTest extends TestCase{
    protected $_serviceName;
    protected $_service;

    public function setUp(){
        parent::setUp();
        $this->_service = $this->app->make("App\Services\GiphySearchInterface");
    }

    public function testSearch(){
        $term = 'he-man';
        $results = $this->_service->search($term);
    }
}