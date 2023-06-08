@extends('admin.index')
@section('form')
<div>
    <h2><Strong>{{ $title }}</Strong></h2>
</div>

<hr>
<form class="form-horizontal" id="form-comics" role="form" method="POST" action="{{ route('admin.contents.post-add-content') }}" enctype="multipart/form-data">
    <input type="hidden" name="id_chapter" value="{{ $id }}">
    
    <div class="form-group">
        <div class="col-xs-12">
            <textarea name="content" id="ckeditor_content" cols="120" rows="50"></textarea>
        </div>
    </div>

    <div class="">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Submit
            </button>

            &nbsp; &nbsp; &nbsp;
            <button class="btn" type="reset">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Reset
            </button>
        </div>
    </div>
    @csrf
</form>
@endsection