@extends('layouts.check')

@section('card-header')
Cities
@endsection
@section('card-body')
  <div class="row">
@foreach($cities as $city)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$city->city_name_en}}</h5>
        <h5>{{$city->city_name_ar}}</h5>
        Country: {{$city->country->country_name}} <br/>
        Governorate: {{$city->governorate->governorate_name_en}} </p>


  </div>
</div>
@endforeach
</div>

{{$cities->links()}}

@endsection
