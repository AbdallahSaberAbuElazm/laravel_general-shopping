@extends('layouts.check')

@section('card-header')
Orders
@endsection
@section('card-body')
  <div class="row">
@foreach($orders as $order)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$order->customer->formattedName()}}</h5>
        <h5>{{$order->cart->cart_item}}</h5>
        Payments: {{$order->payments->amount}}
      </p>
  </div>
</div>
@endforeach
</div>

{{$orders->links()}}

@endsection
