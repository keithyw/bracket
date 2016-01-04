<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 8:34 PM
 */

namespace App\Services;

interface YoutubeSearchInterface {
    /**
     * @param string $term
     * @return array
     */
    public function search($term);
}