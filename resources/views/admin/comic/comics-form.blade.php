@extends('admin.index')
@section('form')
<div>
    <h2><Strong>{{ $title }}</Strong></h2>
</div>

<hr>
<form class="form-horizontal" id="form-comics" role="form" method="POST" action="{{ route('admin.comics.post-add-comic') }}">
    <input type="hidden" name="user_id" value="1">
    
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comic name </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Category name" class="col-xs-10 col-sm-5" name="comic_name"/>
            @error('comic_name')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Short description </label>

        <div class="col-sm-9">
            <textarea name="short_description" id="" cols="50" rows="5"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type comic </label>

        <div class="col-sm-9">
            <select name="type_comic" id="" class="col-xs-10 col-sm-2">
                <option value="Comic">Comic</option>
                <option value="Light-Novel">Light-Novel</option>
            </select>
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