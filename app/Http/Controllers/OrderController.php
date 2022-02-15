<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{


  public function index(){
    $orders = Order::with(['customer','cart','payments'])->paginate(env('PAGINATION_CODE'));
    return view('admin.orders.orders')->with([
      'orders' =>$orders,
    ]);
  }

}
