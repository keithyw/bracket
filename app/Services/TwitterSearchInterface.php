<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/12/16
 * Time: 1:54 AM
 */

namespace App\Services;


interface TwitterSearchInterface {
    /**
     * @param string $term
     * @return array
     */
    public function search($term);
}