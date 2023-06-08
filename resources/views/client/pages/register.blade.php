@extends('client.index')
@section('register')
<div class="login-container">
    <div class="center">
        <h1>
            <i class="ace-icon fa fa-leaf green"></i>
            <span class="red">Mê</span>
            <span class="black" id="id-text2">Truyện</span>
        </h1>
    </div>

    <div class="space-6"></div>

    <div class="position-relative">
        <div id="login-box" class="login-box visible widget-box no-border">
            <div class="widget-body">
                <div id="signup-box" class="signup-box widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header green lighter bigger">
                                <i class="ace-icon fa fa-users blue"></i>
                                Đăng ký người dùng mới
                            </h4>
                            @if(session('msg'))
                            <div class="alert alert-danger">
                                {{session('msg')}}
                            </div>
                            @endif
                            <div class="space-6"></div>
                            <p> Nhập thông tin chi tiết của bạn để bắt đầu: </p>
                
                            <form method="POST" action="{{ route('post-register') }}">
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="email" class="form-control" placeholder="Email" name="email"/>
                                            <i class="ace-icon fa fa-envelope"></i>
                                        </span>
                                        @error('email')
                                        <span style="color: red; margin-left: 10px;"> {{$message}} </span>
                                        @enderror
                                    </label>
                
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Username" name="username"/>
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                                        @error('username')
                                        <span style="color: red; margin-left: 10px;"> {{$message}} </span>
                                        @enderror
                                    </label>
                
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="Password" name="password"/>
                                            <i class="ace-icon fa fa-lock"></i>
                                        </span>
                                        @error('password')
                                        <span style="color: red; margin-left: 10px;"> {{$message}} </span>
                                        @enderror
                                    </label>
                
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="Repeat password" name="repeat_password"/>
                                            <i class="ace-icon fa fa-retweet"></i>
                                        </span>
                                        @error('repeat_password')
                                        <span style="color: red; margin-left: 10px;"> {{$message}} </span>
                                        @enderror
                                    </label>
                
                                    <label class="block">
                                        <input type="checkbox" class="ace" name="argument"/>
                                        <span class="lbl">
                                            Tôi chấp nhận với
                                            <a href="#">Điều khoảng người dùng</a>
                                        </span>
                                    </label>
                
                                    <div class="space-24"></div>
                
                                    <div class="clearfix">
                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                            <i class="ace-icon fa fa-refresh"></i>
                                            <span class="bigger-110">Làm lại</span>
                                        </button>
                
                                        <button type="submit" class="width-65 pull-right btn btn-sm btn-success">
                                            <span class="bigger-110">Đăng ký</span>
                
                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                        </button>
                                    </div>
                                </fieldset>
                                @csrf
                            </form>
                        </div>
                
                        <div class="toolbar center">
                            <a href="{{ route('login') }}" class="back-to-login-link">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Trở về đăng nhập
                            </a>
                        </div>
                    </div><!-- /.widget-body -->
                </div><!-- /.signup-box -->
            </div>
        </div>
    </div>
    <div class="space-18"></div>
</div>   
@endsection
     


