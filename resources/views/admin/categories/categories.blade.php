@extends('layouts.app')

@section('card-header')
Categories
@endsection
@section('card-body')
  <div class="row">
@foreach($categories as $category)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$category->name}}</h5>
      </p>
  </div>
</div>
@endforeach
</div>

{{$categories->links()}}

@endsection
