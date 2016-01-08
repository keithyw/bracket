<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 1/8/16
 * Time: 12:20 PM
 */

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;


class ProcessedMessage extends BaseModel{
    protected $table = 'processed_messages';
    protected $fillable = ['message', 'raw_results'];

    public function rawMessage(){
        return $this->belongsTo('App\Models\RawMessage');
    }

    public function rawResult(){
        return $this->belongsTo('App\Models\RawResult');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}