<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 10/19/15
 * Time: 11:24 AM
 */

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'total_points' => $user->total_points,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];
    }
}

