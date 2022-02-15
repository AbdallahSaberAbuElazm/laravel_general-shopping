<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{


  public function index(){
    $countries = Country::paginate(env('PAGINATEION_COUNT'));
    return view('admin.countries.countries')->with(
      ['countries'=>$countries]
    );
  }

  public function countryEnExists( $countryNameEn){
      $country = Country::where(
        'country_name','=',$countryNameEn
      )->first();
      if(!is_null($country)){
          return false;
      }else
      return true;
  }

  public function countryArExists($countryNameAr){
      $country = Country::where(
        'country_name_ar','=',$countryNameAr
      )->first();
      if(!is_null($country)){
        return false;
    }else
    return true;
  }

  public function store(Request $request){
    $request->validate([
        'country_name_ar' => 'required',
        'country_name_en' => 'required',
    ]);
    $countryAr  = $request->input('country_name_ar');
    $countryEn  = $request->input('country_name_en');

    if(! $this->countryArExists($countryAr)){
        toastr('warning','Country name '.$countryAr.' already exists');
        return redirect()->back();
    }
    if(! $this->countryEnExists($countryEn)){
        toastr('warning','Country name '.$countryEn.' already exists');
        return redirect()->back();
    }

    $country = new Country();
    $country->country_name = $countryEn;
    $country->country_name_ar = $countryAr;
    $country->save();
    toastr('success','Country '.$countryEn.' '.$countryAr.' has been saved');
    return redirect()->back();
  }
}
