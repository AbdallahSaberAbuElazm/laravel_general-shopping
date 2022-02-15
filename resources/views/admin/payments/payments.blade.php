@extends('layouts.check')

@section('card-header')
Payments
@endsection
@section('card-body')
  <div class="row">
@foreach($payments as $payment)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$payment->customer->formatedName()}}</h5>
        {{$payment->order->cart}} <br><br>
        {{$payment->amount}}
        </p>
          </div>


</div>
@endforeach
</div>

{{$payments->links()}}

@endsection
