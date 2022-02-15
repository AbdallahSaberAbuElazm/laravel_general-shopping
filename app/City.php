<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $primaryKey = 'id';

    protected $fillable = [
      'governorate_id' , 'city_name_ar' , 'city_name_en',
    ];

    public function country(){
      return $this->belongsTo(Country::class,'country_id','id');
    }

    public function governorate(){
      return $this->belongsTo(Governorate::class,'governorate_id','id');
    }
}
