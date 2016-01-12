<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/11/16
 * Time: 3:53 PM
 */

namespace App\Services;


interface GiphySearchInterface {
    /**
     * @param string $term
     * @return array
     */
    public function search($term);
}