@extends('admin.index')
@section('profile')
<div>
    <div id="user-profile-1" class="user-profile row">
        
        <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.users.update-profile') }}" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>
            
                    <div class="col-sm-9">
                        <label class="control-label no-padding-right" for="form-field-1" style="color: blueviolet;">{{ $userDetail->USERNAME }}</label>
                        <input type="hidden" id="form-field-1" class="col-xs-10 col-sm-5" name="username" value="{{ $userDetail->USERNAME }}"/>
                    </div>
                </div>
            
                <div class="space-4"></div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Full name </label>
            
                    <div class="col-sm-9">
                        <input type="text" id="form-field-1" placeholder="Full name" class="col-xs-10 col-sm-5" name="fullname" value="{{ $userDetail->FULLNAME }}"/>
                    </div>
                </div>
            
                <div class="space-4"></div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
            
                    <div class="col-sm-9">
                        <input type="text" id="form-field-1" placeholder="Email" class="col-xs-10 col-sm-5" name="email" value="{{ $userDetail->EMAIL }}"/>
                    </div>
                </div>
            
                <div class="space-4"></div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Birthday </label>
            
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input class="col-xs-10 col-sm-10 date-picker" id="id-date-picker-1" type="datetime" data-date-format="yyyy-mm-dd" placeholder="Birthday" name="birthday" value="{{ $userDetail->BIRTHDAY }}"/>
                        </div>
                    </div> 
                </div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type account </label>
            
                    <div class="col-sm-9">
                        <label class="control-label no-padding-right" for="form-field-1" style="color: blueviolet;"> {{ $userDetail->ACCOUNT_TYPE }} </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Avatar </label>
                    
                    <div class="col-sm-9">
                        <div>
                            <span class="col-sm-9">
                                {{-- <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" /> --}}
                                <input type="file" name="avatar"  onchange="readURL(this);">
                                <div class="space-4"></div>
                                <div style="border-style: groove; width: fit-content">
                                    <img src="data:image/jpeg;base64, {{ $userDetail->USER_AVATAR }}" alt="" id="avatar" width="160" height="200"> 
                                </div>
                                    
                            </span>       
                            <div class="space-4"></div>
                        </div>
                    </div>
                </div>
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#avatar').attr('src', e.target.result).width(150).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection