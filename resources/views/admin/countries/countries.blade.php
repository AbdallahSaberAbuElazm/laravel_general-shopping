@extends('layouts.check')

@section('card-header')
Countries
@endsection
@section('card-body')

<form action="{{route('countries')}}" class="row" method="post">
    @csrf
    <div class="form-group col-md-6">
        <label for="country_name_en">
            Country Name En
        </label>
        <input type="text" class="form-control" id="country_name_en" name="country_name_en" placeholder="Enter country name" required>
    </div>
    <div class="form-group col-md-6">
        <label for="country_name_ar">
            Country Name Ar
        </label>
        <input type="text" class="form-control" id="country_name_ar" name="country_name_ar" placeholder="ادخل البيانات باللغة العربية" required>
    </div>
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary" id="save">Save New Country</button>
    </div>
</form>
  <div class="row">
@foreach($countries as $country)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$country->country_name}}</h5>
        <h5>{{$country->country_name_ar}}</h5>
      </p>
  </div>
</div>
@endforeach
</div>

{{$countries->links()}}

@endsection
