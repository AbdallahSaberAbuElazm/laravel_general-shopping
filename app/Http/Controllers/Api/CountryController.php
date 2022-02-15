<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\GovernorateResource;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        return CountryResource::collection(Country::paginate());
    }

    public function showGovernorates($id){
        $country = Country::find($id);
        return GovernorateResource::collection($country->governorates);
    }

    public function showCities($id){
        $country = Country::find($id);
        return CityResource::collection($country->cities);
    }
}
