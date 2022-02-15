@extends('layouts.app')

@section('card-header')
Units
@endsection
@section('card-body')
<form action="{{route('units')}}" class="row" method="post">
    @csrf
    <div class="form-group col-md-6">
        <label for="unit_name">
            Unit Name
        </label>
        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Enter unit name" required>
    </div>
    <div class="form-group col-md-6">
        <label for="unit_code">
            Unit Code
        </label>
        <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Enter unit code" required>
    </div>
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary" id="save">Save New Unit</button>
    </div>
</form>

<div class="row">
    @foreach($units as $unit)
    <div class="col-md-3">
        <div class="alert alert-primary" role='alert'>
            <h5>
                <p> {{$unit->unit_name}}, {{$unit->unit_code}}</p>
            </h5>
            <span class="buttons-span">
                <span> <a class="edit-unit" data-unitid="{{ $unit->id }}" data-unitname="{{ $unit->unit_name }}"
                        data-unitcode="{{ $unit->unit_code}}"><i class="fas fa-edit"></i></a></span>
                <span><a class="delete-unit" data-unitid="{{ $unit->id }}" data-unitname="{{ $unit->unit_name }}"
                        data-unitcode="{{ $unit->unit_code}}"><i class="fas fa-trash"></i></a></span>
            </span>
        </div>
    </div>
    @endforeach
</div>

{{ (!is_null($showLinks) && $showLinks)? $units->links() : ''}}

<form action="{{route('search-units')}}" class="row" method="post">
    @csrf
    <div class="form-group col-md-6">
        <input type="text" class="form-control" id="unit_search" name="unit_search" placeholder="Enter unit name or code" required>
    </div>
    <div class="form-group">
        <button type="submit"  class="btn btn-primary form-control" id="search">SEARCH</button>
    </div>
</form>


<!-- modal for edit units  -->
<div class="modal edit-window" id="edit-window" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('units')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name='_method' value="PUT">
                    <input type="hidden" name="edit_unit_id" id="edit_unit_id">
                    <div>
                        <label for="unit_name">
                            Unit Name
                        </label>
                        <input type="text" class="form-control" id="edit_unit_name" name="unit_name"
                            placeholder="Enter unit name" required>
                    </div>
                    <div>
                        <label for="unit_code">
                            Unit Code
                        </label>
                        <input type="text" class="form-control" id="edit_unit_code" name="unit_code"
                            placeholder="Enter unit code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit unit</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal for delete unit  -->
<div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('units')}}" method="post">
                @csrf
                <div class="modal-body">
                    <p id="delete-message"></p>
                    <input type="hidden" name='_method' value="delete">
                    <input type="hidden" name="unit_id" id="unit_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>
    $(document).ready(function ($) {
        var $deleteUnit = $('.delete-unit');
        var $deleteWindow = $('#delete-window');
        var $unitId = $('#unit_id');
        var $deleteMessage = $('#delete-message');
        $deleteUnit.on('click', function (element) {
            element.preventDefault();
            $unitId.val($(this).data('unitid'));
            var unitName = $(this).data('unitname');
            var unitCode = $(this).data('unitcode');
            $deleteMessage.text('Are you sure you want to delete ' + unitName + ' , ' + unitCode + ' ?');
            $deleteWindow.modal('show');
        });

        $editUnit = $('.edit-unit');
        $editWindow = $('#edit-window');
        $unitName = $('#edit_unit_name');
        $unitCode = $('#edit_unit_code');
        $editUnitId = $('#edit_unit_id');
        $editUnit.on('click', function (element) {
            element.preventDefault();
            $unitName.val($(this).data('unitname'));
            $unitCode.val($(this).data('unitcode'));
            $editUnitId.val($(this).data('unitid'));
            $editWindow.modal('show');
        });
    });
</script>
@endsection
