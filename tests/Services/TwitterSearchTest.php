<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/12/16
 * Time: 2:17 PM
 */

class TwitterSearchTest extends TestCase {
    protected $_serviceName;
    protected $_service;

    public function setUp(){
        parent::setUp();
        $this->_service = $this->app->make("App\Services\TwitterSearchInterface");
    }

    public function testSearch(){
        $term = 'diablo 3';
        $results = $this->_service->search($term);
        print_r($results);
        $arr = [];
        if (isset($results['statuses'])){
            foreach ($results['statuses'] as $tweet){
                $arr[]= ['id' => $tweet['id']];
            }
        }
        print_r($arr);
    }
}