<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/31/15
 * Time: 1:28 AM
 */

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;

class RawResult extends BaseModel {
    protected $table = 'raw_results';
    protected $fillable = ['type', 'term', 'results'];

    public function processedMessage(){
        return $this->hasOne('App\Models\ProcessedMessage');
    }
}