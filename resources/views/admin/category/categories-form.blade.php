@extends('admin.index')
@section('form')
<div>
    <h2>Add Category</h2>
    <hr>
    <a href="#">
        <button class="btn btn-primary" type="button">Add Category</button>
    </a>
</div>

<hr>
<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.categories.post-add-category') }}">
    
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category name </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Category name" class="col-xs-10 col-sm-5" name="category_name"/>
            @error('username')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Description </label>

        <div class="col-sm-9">
            <textarea name="description" id="" cols="52" rows="10"></textarea>
            @error('password')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
        
    </div>

    <div class="clearfix form-actions">
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