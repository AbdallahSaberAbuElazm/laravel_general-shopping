<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table = 'governorates';

    protected $primaryKey = 'id';

    protected $fillable =[
      'governorate_name_ar' , 'governorate_name_en',
    ];

    public function cities(){
      return $this->hasMany(City::class,'governorate_id','id');
    }

    public function country(){
      return $this->belongsTo(Country::class);
    }
}
