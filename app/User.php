<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
       'first_name','last_name','email','email_verified_at',
       'mobile','mobile_verified_at','password','shipping_address',
       'billing_address'
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token',
    ];



    public function orders(){
      return $this->hasMany(Order::class);
    }

    public function payments(){
      return $this->hasMany(Payment::class);
    }

    public function shipments(){
      return $this->hasMany(Shipment::class);
    }

    public function shippingAddress(){
      return $this->hasOne(Address::class,'id','shipping_address');
    }

    public function billingAddress(){
      return $this->hasOne(Address::class,'id','billing_address');
    }

    public function wishList(){
      $this->hasOne(WishList::class);
    }

    public function reviews(){
      $this->hasMany(Review::class);
    }


    public function roles(){
      return $this->belongsToMany(Role::class);
    }

    public function formattedName(){
      return $this->first_name.' '.$this->last_name;
    }


}
