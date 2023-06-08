@extends('admin.index')
@section('users')
<div>
    <h2>Add users</h2>
    <hr>
    <a href="{{ route('admin.users.add') }}">
        <button class="btn btn-primary" type="button">Add User</button>
    </a>
</div>

<hr>
<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.users.post-add') }}">
    
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" name="username"/>
            @error('username')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Password </label>

        <div class="col-sm-9">
            <input type="password" id="form-field-2" placeholder="Password" class="col-xs-10 col-sm-5" name="password"/>
            @error('password')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
        
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Full name </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Full name" class="col-xs-10 col-sm-5" name="fullname"/>
            @error('fullname')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" placeholder="Email" class="col-xs-10 col-sm-5" name="email"/>
            @error('email')
                <span style="color: red; margin-left: 10px;"> {{$message}} </span>
            @enderror
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Birthday </label>

        <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5 date-picker" id="id-date-picker-1" type="datetime" data-date-format="yyyy-mm-dd" placeholder="Birthday" name="birthday"/>
                @error('birthday')
                    <span style="color: red; margin-left: 10px;"> {{$message}} </span>
                @enderror
        </div> 
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type account </label>

        <div class="col-sm-9">
            <select name="account_type" id="" class="col-xs-10 col-sm-1">
                <option value="USER">User</option>
                <option value="ADMIN">Admin</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gender </label>

        <div class="col-sm-9">
            <select name="gender" id="" class="col-xs-10 col-sm-1">
                <option value="0">Male</option>
                <option value="1">Female</option>
                <option value="2">Other</option>
            </select>
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