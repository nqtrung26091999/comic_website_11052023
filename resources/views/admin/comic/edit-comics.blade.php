@extends('admin.index')
@section('form')
<div>
    <h2><Strong>{{ $title }}</Strong></h2>
</div>

<hr>
<form class="form-horizontal" id="form-comics" role="form" method="POST" action="{{ route('admin.comics.post-edit-comic') }}" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="1">
    
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comic name </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Category name" class="col-xs-10 col-sm-5" name="comic_name" value="{{ $comicDetails->COMIC_NAME }}"/>
            @error('comic_name')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Short description </label>

        <div class="col-sm-9">
            <textarea name="short_description" id="" cols="50" rows="5">{{ $comicDetails->SHORT_DESCRIPTION }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total chapters </label>

        <div class="col-sm-9">
            <input type="number" id="form-field-1" placeholder="Total chapters" class="col-xs-10 col-sm-5" name="total_chapters" value="{{ $comicDetails->TOTAL_CHAPTERS }}"/>
            @error('username')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type comic </label>

        <div class="col-sm-9">
            <select name="type_comic" id="" class="col-xs-10 col-sm-2">
                
                <option value="Comic" 
                @if ($comicDetails->TYPE == 'Comic')
                    selected
                @endif>Comic</option>
                <option value="Light-Novel"
                @if ($comicDetails->TYPE == 'Light-Novel')
                    selected
                @endif>Light-Novel</option>
            </select>
        </div>
    </div>

    <div class="form-group">

        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Categories </label>
        <div class="col-sm-5">
        @if ($allData)
            @foreach ($allData as $item)
                    <input name="holding_category[]" type="checkbox" class="ace" value={{ $item->CATEGORY_ID }}
                        @foreach ($holdingData as $item_holding)
                            @if ($item_holding->CATEGORY_ID == $item->CATEGORY_ID && $item_holding->COMIC_ID == $comicDetails->COMIC_ID)
                                @checked(true)
                            @endif
                        @endforeach
                    /><label class="lbl"> {{ $item->CATEGORY_NAME }} </label>
            @endforeach
        @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cover image </label>
        
        <div class="col-sm-9">
            <div>
                <span class="col-sm-9">
                    {{-- <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" /> --}}
                    <input type="file" name="cover" onchange="readURL(this);">
                    <div class="space-4"></div>
                    <div style="border-style: groove; width: fit-content">
                        <img src="data:image/jpeg;base64, {{ $comicDetails->COVER }}" alt="" id="cover" width="160" height="200"> 
                    </div>
                        
                </span>       
                <div class="space-4"></div>
            </div>
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#cover').attr('src', e.target.result).width(150).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection