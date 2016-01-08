<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 4:39 PM
 */

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;

class RawMessage extends BaseModel{
    protected $table = 'raw_messages';
    protected $fillable = ['message'];

    public function processedMessage(){
        return $this->hasOne('App\Models\ProcessedMessage');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}