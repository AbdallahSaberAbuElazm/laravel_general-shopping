<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Governorate;

class GovernorateController extends Controller
{


  public function index(){
    $governorates = Governorate::with(['country','cities'])->paginate(env('PAGINATEION_COUNT'));
    return view('admin.governorates.governorates')->with(
      ['governorates'=>$governorates]
    );
  }
}
