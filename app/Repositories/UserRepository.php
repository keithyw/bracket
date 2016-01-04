<?php

namespace App\Repositories;

use Conark\Jackhammer\RepositoryWrapper;
use App\Models\User;

class UserRepository extends RepositoryWrapper implements UserRepositoryInterface
{
    public function __construct(User $model){
        parent::__construct($model);
    }
}