@extends('layouts.app')

@section('card-header')
Products <a href="{{route('new-product')}}" class="btn btn-primary"> Add Product</a>
@endsection
@section('card-body')
<div class="row">
    @foreach($products as $product)
    <div class="col-md-3">
        <div class="alert alert-primary" role='alert'>
            <!-- {{$product->id}} -->
            <p>
            <h5>Product Title : </h5> {{$product->title}}</p>
            <p>
            <h5>Category : </h5> {{(is_object( $product->category))? $product->category->name:''}}</p>
            <p> Price: {{$currency_code}} {{$product->price}}</p>
            <!-- images  -->
            {!! (count($product->images) > 0) ? '<img class="img-thumbnail card-img mt-2" src="'.asset("storage/".$product->images[0]->url).'" />':'' !!}
            <!-- /images  -->
            <br>

            <!-- options  -->
            @if(!is_null($product->options))
            @foreach( $product->jsonOptions() as $key => $values )
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="{{$key}}">
                        {{$key}}
                    </label>
                    <select type='text' class="form-control" name="{{$key}}" id="{{$key}}">
                        @foreach($values as $value)
                        <option value="{{$value}}">
                            {{$value}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
            @endif
            <!-- /options  -->

            <br>
            <a href="{{route('new-product',['id'=>$product->id])}}" class="btn btn-success mt-2">Update Product</a>
        </div>
    </div>
    @endforeach
</div>

{{$products->links()}}

@endsection
