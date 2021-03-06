<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{

  public function index(){
    $reviews = Review::with(['customer',])->paginate(env('PAGINATEION_COUNT'));
    return view('admin.reviews.reviews')->with(
      ['reviews'=>$reviews]
    );
  }
}
