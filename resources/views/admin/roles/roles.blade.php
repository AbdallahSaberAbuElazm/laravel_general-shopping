@extends('layouts.app')

@section('card-header')
Roles
@endsection
@section('card-body')
  <div class="row">
@foreach($roles as $role)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
    <p><h5>{{$role->role}}</h5></p>
      {{$role->showUsers()}}
  </div>
</div>
@endforeach
</div>

{{$roles->links()}}

@endsection
