<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/12/16
 * Time: 7:12 PM
 */

namespace App\Services;


interface BaseSearchInterface {
    /**
     * @param string $term
     * @return array
     */
    public function search($term);
}