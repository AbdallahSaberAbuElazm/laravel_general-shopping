<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{


  public function index(){
    $cities = City::with(['country','governorate'])->paginate(env('PAGINATEION_COUNT'));
    return view('admin.cities.cities')->with(
      ['cities'=>$cities]
    );
  }
}
