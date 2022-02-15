@extends('layouts.app')

@section('card-header')
Tickets
@endsection
@section('card-body')
  <div class="row">
@foreach($tickets as $ticket)
<div class="col-md-4">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$ticket->customer->formattedName()}}</h5>
        Ticket Type: {{$ticket->tickettype->type}} <br>

         <div class="card border-primary mb-3" >

             <div class="card-body">
             <h5 class="card-title">{{$ticket->title}} </h5>
             <p class="card-text">{{$ticket->message}}</p>
             </div>
           </div>
           Status: {{$ticket->status}}

      </p>
  </div>
</div>
@endforeach
</div>

{{$tickets->links()}}

@endsection


