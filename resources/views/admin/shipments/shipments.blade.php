@extends('layouts.app')

@section('card-header')
Shipments
@endsection
@section('card-body')
  <div class="row">
@foreach($shipments as $shipment)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>

    <p><h5>{{($shipment->customer->formattedName() !=null)? $shipment->customer->formattedName():''}}</h5>
    <h5>Order : </h5> {{($shipment->order->cart != null) ? $shipment->order->cart:''}} <br>
    Price: {{$currency_code}} {{($shipment->payment->amount > 0 )? $shipment->payment->amount: ''}} <br>
    Status : {{$shipment->status}} <br>
      Date: {{$shipment->humanFormattedDate()}} <br>
    </p>
  </div>
</div>
@endforeach
</div>

{{$shipments->links()}}

@endsection
