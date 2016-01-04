<?php

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;

class Job extends BaseModel
{
    protected $table = 'jobs';

    protected $fillable = ['queue','payload','attempts','reserved','reserved_at','available_at'];

    protected $hidden = ['id','created_at','updated_at'];

}
