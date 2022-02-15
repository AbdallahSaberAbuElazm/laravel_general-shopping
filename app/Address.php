<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected $fillable=[
    'street_number','street_name','post_code','city','governorate',
    'country'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function showAddress(){
    return $this->street_number.' '.$this->street_name.' '.$this->city.' '.$this->governorate.' '.$this->country;
  }
}
