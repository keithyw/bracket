<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/7/16
 * Time: 11:18 PM
 */

namespace App\Services;


interface GoogleGeocodingSearchInterface {
    /**
     * @param string $address
     * @return array
     */
    public function search($address);
}