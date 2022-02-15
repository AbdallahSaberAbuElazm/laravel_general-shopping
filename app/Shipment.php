<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Shipment extends Model
{
    protected $fillable=[
      'user_id','order_id','payment_id','status',
      'shipment_date'
    ];

    public function customer(){
      return $this->belongsTo(User::class,'id','user_id');
    }

    public function order(){
      return $this->belongsTo(Order::class);
    }

    public function payment(){
      return $this->hasOne(Payment::class);
    }

    public function humanFormattedDate(){
      return Carbon::createFromTimeStamp( strtotime($this->created_at))->diffForHumans();
    }
}
