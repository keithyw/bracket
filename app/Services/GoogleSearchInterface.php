<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/7/16
 * Time: 7:30 PM
 */

namespace App\Services;


interface GoogleSearchInterface {
    /**
     * @param string $term
     * @return array
     */
    public function search($term);
}