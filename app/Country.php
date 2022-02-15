<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=[
      'country_name','country_name_ar'
    ];

    public function governorates(){
      return $this->hasMany(Governorate::class,'country_id','id');
    }

    public function cities(){
      return $this->hasMany(City::class,'country_id','id');
    }

}
