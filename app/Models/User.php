<?php

namespace App\Models;

use Conark\Jackhammer\Models\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel  implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'users';

    protected $fillable = ['name','first_name','last_name','address_id','sweepstakes_total','agree_offers','opt_out','opt_out_token'];

    protected $hidden = ['email','zipcode','epsilon_profile_id','needs_epsilon_update','total_points','remember_token','password','birthday','id','created_at','updated_at'];

    protected $rules = [
        'name' => 'Max:255',
        'first_name' => 'Max:255',
        'last_name' => 'Max:255',
        'address_id' => 'Integer',
        'sweepstakes_total' => 'Integer',
        'agree_offers' => 'Boolean',
        'opt_out' => 'Boolean',
        'opt_out_token' => 'Max:255',
    ];

    public function address(){
        return $this->belongsTo('App\Models\Address');
    }

    public function auctions(){
        return $this->hasMany('App\Models\Auction');
    }

    public function auctionBids(){
        return $this->hasMany('App\Models\AuctionBid');
    }

    public function auctionWinners(){
        return $this->hasMany('App\Models\AuctionWinner');
    }

    public function cartItems(){
        return $this->hasMany('App\Models\CartItem');
    }

    public function notifications(){
        return $this->hasMany('App\Models\Notification');
    }

    public function orderItems(){
        return $this->hasMany('App\Models\OrderItem');
    }

    public function socialConnections(){
        return $this->hasMany('App\Models\SocialConnection');
    }

    public function sweepstakes(){
        return $this->hasMany('App\Models\Sweepstake');
    }

    public function userRoles(){
        return $this->hasMany('App\Models\UserRole');
    }

    public function userTransactionHistory(){
        return $this->hasMany('App\Models\UserTransactionHistory');
    }

    public function wishlistItems(){
        return $this->hasMany('App\Models\WishlistItem');
    }

    public function rawMessages(){
        return $this->hasMany('App\Models\User');
    }

}
