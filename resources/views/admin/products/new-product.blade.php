@extends('layouts.app')

@section('card-header')
{!! (is_null($product))? 'New Product' : 'Update Product : <span class="update-product-btn">'. $product->title.'</span>'
!!}
@endsection

@section('card-body')

<form action="{{(is_null($product))? route('products') : route('update-product')}}" enctype="multipart/form-data"
    class="row" method="post">
    @csrf
    {!! (!is_null($product))? '<input type="hidden" name="_method" value="PUT"><input type="hidden" name="edit_unit_id"
        id="edit_unit_id">' : ''!!}
    <div class="form-group col-md-12">
        <label for="product_title">
            Product Title
        </label>
        <input type="text" class="form-control" id="product_title" name="product_title"
            value="{{(is_null($product))? '' : $product->title}}" placeholder="Please enter the product title" required>
    </div>
    <div class="form-group col-md-12">
        <label for="product_description">
            Product description
        </label>
        <textarea class="form-control" name="product_description" id="product_description" cols="30" rows="5"
            placeholder="Please enter the product description"
            required>{{(is_null($product))? '' : $product->description}}</textarea>
    </div>
    <div class="form-group col-md-12">
        <label for="product_description">
            Product Unit
        </label>
        <select class="form-control" name="product_unit" id="product_unit">
            <option value="">Select a unit</option>
            @foreach($units as $unit)
            <option value="{{$unit->id}}" {{((!is_null($product)) && ($product->hasUnit->id === $unit->id))? 'selected'
                :
                ''}}> {{$unit->formattedUnit()}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-12">
        <label for="product_category">
            Product Category
        </label>
        <select class="form-control" name="product_category" id="product_category">
            <option value="">Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}" {{((!is_null($product)) && ($product->category->id === $category->id))?
                'selected'
                :
                ''}}> {{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="product_price">
            Product price
        </label>
        <input type="number" step="any" class="form-control" id="product_price" name="product_price"
            value="{{(is_null($product))? '' : $product->price}}" placeholder="Please enter the product price" required>
    </div>
    <div class="form-group col-md-6">
        <label for="product_discount">
            Product discount
        </label>
        <input type="number" step="any" class="form-control" id="product_discount" name="product_discount"
            value="{{(is_null($product))? '' : $product->discount}}" placeholder="Please enter the product discount"
            required>
    </div>
    <div class="form-group col-md-6">
        <label for="product_total">
            Product Total
        </label>
        <input type="number" class="form-control" id="product_total" name="product_total"
            value="{{(is_null($product))? '' : $product->total}}" placeholder="Please enter the product total" required>
    </div>
    <!-- options -->
    <div class="form-group col-md-12">
        {!! (!is_null($product) && !is_null($product->options)) ? '<h6 class="mt-3">Options</h6>' : ''!!}
        <table id="options-table" class="table table-striped">

        </table>
        <a href="#" class="btn btn-outline-dark options-btn">Add Options</a>
    </div>
    <!-- /opitons  -->

    <!-- images  -->
    <div class="form-group col-md-12">
        <label for="product_images">
            Product Images
        </label>
        <div class="row">
            @for($i = 0; $i < 6; $i++) <div class="col-md-4 col-sm-12 mb-4">
                <div class="card card-file-upload">
                    <a href="" class="activate_image_upload" data-fileid="image-{{$i}}">
                        <div class="card-body" style="text-align: center;">
                            @if( !is_null($product) && isset($product->images[$i])&& !is_null($product->images[$i]) && count($product->images)>0)
                                <img class="img-thumbnail card-img mt-2" src="{{asset("storage/".$product->images[$i]->url)}}"/>
                            @endif
                        </div>
                    </a>
                    <input name="product_images[]" type="file" class="form-control-file image-file-upload"
                        id="image-{{$i}}">
                </div>
        </div>
        @endfor
    </div>

    </div>
    <!-- /images  -->

    <!-- save button  -->
    <div class="form-group col-md-6 offset-md-3">
        <button class="btn btn-primary btn-block">Save</button>
    </div>
    <!-- /save button  -->

</form>

<!-- modal for options  -->
<div class="modal option-window" id="option-window" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Option</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div  class="form-group col-md-6">
                    <label for="unit_name">
                        Option name
                    </label>
                    <input type="text" class="form-control" id="option_name" name="unit_name"
                        placeholder="Enter option name" required>
                </div>
                <div  class="form-group col-md-6">
                    <label for="unit_code">
                        Option value
                    </label>
                    <input type="text" class="form-control" id="option_value" name="unit_code"
                        placeholder="Enter option" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary add-option-btn">Add Option</button>

            </div>
        </div>
    </div>

</div>


@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var $optionBtn = $('.options-btn');
        var $optionWindow = $('#option-window');
        var $deleteWindow = $('#delete-window');
        var $optionTable = $('#options-table');
        var optionNamesList = '';
        var arrayOptionList = [];
        var $activateImageUpload = $('.activate_image_upload');
        var $cardFileUpload = $('.card-file-upload');

        $optionBtn.on('click', function (e) {
            e.preventDefault();
            $optionWindow.modal('show');
        });

        $(document).on('click', '.add-option-btn', function (e) {
            e.preventDefault();
            var $optionName = $('#option_name');
            var $optionValue = $('#option_value');
            if ($optionName.val() === '') {
                alert('Option name is required');
                return false;
            }
            if ($optionValue.val()  === '') {
                alert('Option value is required');
                return false;
            }

            if (!arrayOptionList.includes($optionName.val() )) {
                arrayOptionList.push($optionName.val() );
                optionNamesList = `
                   <input type="hidden" name="options[]" value="`+ $optionName.val()  + `" >
                `;
            }

            var optionRow = `
            <tr>
                <td>
                   `+ $optionName.val()  + `
                </td>
                <td>
                    `+ $optionValue.val()  + `
                </td>
                <td>
                    <a class="btn remove-option">remove</a>
                    <input type='hidden' name="`+ $optionName.val()  + `[]" value= "` + $optionValue.val()  + `">
                </td>
            </tr>
            `;
            $optionTable.append(optionRow);
            $optionTable.append(optionNamesList);

            $optionValue.val('');
        });

        $(document).on('click', '.remove-option', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        function readURL(input, imageId){
            if(input.files && input.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                    $(imageId).attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $activateImageUpload.on('click', function (e) {
            e.preventDefault();
            var fileUploadId = $(this).data('fileid');
            $('#'+fileUploadId).trigger('click');
            var $imageUpload = '<img src=""  id="i'+fileUploadId+'" class="card-img-top">';
            $(this).append($imageUpload);
            $('#'+fileUploadId).on('change',function(e){
                readURL(this, '#i'+fileUploadId)
            });

        });
    });
</script>
@endsection
