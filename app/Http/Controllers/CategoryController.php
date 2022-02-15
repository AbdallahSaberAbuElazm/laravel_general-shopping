<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
  public function index(){
    $categories = Category::paginate( env('PAGINATEION_COUNT'));
    return view('admin.categories.categories')->with(['categories'=>$categories]);
  }
}
