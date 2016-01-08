<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/7/16
 * Time: 11:07 PM
 */

namespace App\Services;


interface GoogleMapsSearchInterface {
    /**
     * @param string $term
     * @return array
     */
    public function search($term);
}