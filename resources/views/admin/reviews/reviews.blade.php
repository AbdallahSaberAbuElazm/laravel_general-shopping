@extends('layouts.check')

@section('card-header')
Reviews
@endsection
@section('card-body')
  <div class="row">
@foreach($reviews as $review)
<div class="col-md-3">
  <div class="alert alert-primary" role='alert'>
      <p>
        <h5>{{$review->customer->formattedName()}}</h5>
        Product: {{$review->products->title}} <br>
        Stars:
        @php
        $totalStars = 5;
        @endphp
        @for($i=0;$i<$review->stars;$i++)
        <i class="fas fa-star"></i>
          @endfor
        @for($i=0;$i<($totalStars - $review->stars);$i++)
        <i class="far fa-star"></i>
        @endfor
          <br>
        {{$review->review}} <br><br>
        Date: {{$review->humanFormattedDate()}}
      </p>
  </div>
</div>
@endforeach
</div>

{{$reviews->links()}}

@endsection
