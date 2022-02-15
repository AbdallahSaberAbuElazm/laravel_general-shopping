<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipment;

class ShipmentController extends Controller
{

  public function index(){
    $shipments = Shipment::with(['customer','order','payment'])->paginate(env('PAGINATION_CODE'));
    return view('admin.shipments.shipments')->with([
      'shipments' => $shipments,
    ]);
  }

}
