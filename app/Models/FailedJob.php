<?php

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;

class FailedJob extends BaseModel
{
    protected $table = 'failed_jobs';

    protected $fillable = ['connection','queue','payload','failed_at'];

    protected $hidden = ['id','created_at','updated_at'];

}
