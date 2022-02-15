<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=[
      'amount','user_id','order_id','paid_on',
      'payment_reference'
    ];

    public function customer(){
      return $this->belongsTo(User::class,'id','user_id ');
    }

    public function order(){
      return $this->belongsTo(Order::class);
    }


}
