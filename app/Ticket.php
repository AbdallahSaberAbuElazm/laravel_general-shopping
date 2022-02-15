<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable =[
      'user_id','order_id','ticket_type_id',
      'title','message','status',
    ];

    public function customer(){
      return $this->belongsTo(User::class,'user_id','id');
    }

    public function order(){
      return $this->belongsTo(Order::class,'order_id','id');
    }

    public function tickettype(){
      return $this->belongsTo(TicketType::class,'ticket_type_id','id');
    }
}
