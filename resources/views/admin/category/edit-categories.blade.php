@extends('admin.index')
@section('form')
<div>
    <div id="user-profile-1" class="user-profile row">
        
        <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.categories.post-edit-category') }}" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category name </label>
            
                    <div class="col-sm-9">
                        <input type="text" id="form-field-1" class="col-xs-10 col-sm-5" name="category_name" value="{{ $categoryDetails->CATEGORY_NAME }}"/>
                    </div>
                </div>
            
                <div class="space-4"></div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Description </label>
            
                    <div class="col-sm-9">
                        <textarea name="description" id="" class="col-xs-10 col-sm-5" cols="30" rows="10">{{$categoryDetails->CATEGORY_DESCRIPTION }}</textarea>
                    </div>
                </div>
            
                <div class="space-4"></div>

                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Save
                        </button>
                        &nbsp; &nbsp; &nbsp;
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection