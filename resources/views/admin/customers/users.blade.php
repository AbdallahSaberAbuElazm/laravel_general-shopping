@extends('layouts.app')

@section('card-header')
Users
@endsection
@section('card-body')
  <div class="row">
@foreach($users as $user)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$user->formattedName()}}</h5>
        {{($user->billingAddress!=null)? $user->billingAddress->showAddress():''}}
      </p>
  </div>
</div>
@endforeach
</div>

{{$users->links()}}

@endsection
