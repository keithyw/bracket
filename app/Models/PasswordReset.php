<?php

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;

class PasswordReset extends BaseModel
{
    protected $table = 'password_resets';

    protected $fillable = ['email','token'];

    protected $hidden = ['id','created_at','updated_at'];

}
