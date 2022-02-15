@extends('layouts.check')

@section('card-header')
Governorates
@endsection
@section('card-body')
  <div class="row">
@foreach($governorates as $governorate)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$governorate->governorate_name_en}}</h5>
        <h5>{{$governorate->governorate_name_ar}}</h5>
        Country: {{$governorate->country->country_name}}
      </p>
  </div>
</div>
@endforeach
</div>

{{$governorates->links()}}

@endsection
