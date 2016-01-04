<?php

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;

class Migration extends BaseModel
{
    protected $table = 'migrations';

    protected $fillable = ['migration','batch'];

    protected $hidden = ['id','created_at','updated_at'];

}
