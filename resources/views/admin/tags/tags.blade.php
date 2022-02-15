@extends('layouts.check')

@section('card-header')
Tags
@endsection
@section('card-body')
<form action="{{route('tags')}}" class="row" method="POST">
    @csrf
    <div class="form-group col-md-6">
        <label for="tag_name">
            Tag Name
        </label>
        <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Enter tag name" required>
    </div>
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary" id="save">Save New Tag</button>
    </div>
</form>

<div class="row">
    @foreach($tags as $tag)
    <div class="col-md-3">
        <div class="alert alert-primary" role='alert'>
            <p>
            <h5>{{$tag->tag}}</h5>
            </p>
            <span class="buttons-span">
                <span> <a class="edit-tag" data-tagid="{{ $tag->id }}" data-tagname="{{ $tag->tag }}"><i
                            class="fas fa-edit"></i></a></span>
                <span><a class="delete-tag" data-tagid="{{ $tag->id }}" data-tagname="{{ $tag->tag }}"><i
                            class="fas fa-trash"></i></a></span>
            </span>
        </div>
    </div>
    @endforeach
</div>

{{ (!is_null($showLinks) && $showLinks)? $tags->links() : ''}}
<!-- search data -->
<form action="{{route('search-tags')}}" class="row" method="post">
    @csrf
    <div class="form-group col-md-6">
        <input type="text" class="form-control" id="tag_search" name="tag_search" placeholder="Enter tag name" required>
    </div>
    <div class="form-group">
        <button type="submit"  class="btn btn-primary form-control" id="search">SEARCH</button>
    </div>
</form>

<!-- modal for edit tags  -->
<div class="modal edit-window" id="edit-window" tabindex="-1" role="dialog"> -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('tags')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name='_method' value="PUT">
                    <input type="hidden" name="edit_tag_id" id="edit_tag_id">
                    <div>
                        <label for="tag_name">
                            tag Name
                        </label>
                        <input type="text" class="form-control" id="edit_tag_name" name="tag_name"
                            placeholder="Enter tag name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit tag</button>

                </div>
            </form>
        </div>
    </div>

</div>

<!-- modal for delete tag  -->
<div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('tags')}}" method="post">
                @csrf
                <div class="modal-body">
                    <p id="delete-message"></p>
                    <input type="hidden" name='_method' value="delete">
                    <input type="hidden" name="tag_id" id="tag_id">
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
        var $deletetag = $('.delete-tag');
        var $deleteWindow = $('#delete-window');
        var $tagId = $('#tag_id');
        var $deleteMessage = $('#delete-message');
        $deletetag.on('click', function (element) {
            element.preventDefault();
            $tagId.val($(this).data('tagid'));
            var tagName = $(this).data('tagname');
            $deleteMessage.text('Are you sure you want to delete ' + tagName +' ?');
            $deleteWindow.modal('show');
        });

        $edittag = $('.edit-tag');
        $editWindow = $('#edit-window');
        $tagName = $('#edit_tag_name');
        $edittagId = $('#edit_tag_id');
        $edittag.on('click', function (element) {
            element.preventDefault();
            $tagName.val($(this).data('tagname'));
            $edittagId.val($(this).data('tagid'));
            $editWindow.modal('show');
        });
    });
</script>
@endsection

