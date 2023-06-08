@extends('client.index')
@section('login')
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
                <div class="widget-main">
                    <h4 class="header blue lighter bigger">
                        <i class="ace-icon fa fa-coffee green"></i>
                        Vui lòng nhập thông tin của bạn
                    </h4>
                    @if(session('msg'))
                        <div class="alert alert-danger">
                            {{session('msg')}}
                        </div>
                    @endif

                    <div class="space-6"></div>

                    <form action="{{ route('post-login') }}" method="POST">
                        <fieldset>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Username" name="username"/>
                                    <i class="ace-icon fa fa-user"></i>
                                    @error('username')
                                    <span style="color: red; margin-left: 10px;"> {{$message}} </span>
                                    @enderror
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                                    <i class="ace-icon fa fa-lock"></i>
                                    @error('password')
                                    <span style="color: red; margin-left: 10px;"> {{$message}} </span>
                                    @enderror
                                </span>
                            </label>

                            <div class="space"></div>

                            <div class="clearfix">
                                <label class="inline">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"> Ghi nhớ đăng nhập</span>
                                </label>

                                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-key"></i>
                                    <span class="bigger-110">Đăng nhập</span>
                                </button>
                            </div>

                            <div class="space-4"></div>
                        </fieldset>
                        @csrf
                    </form>
                </div><!-- /.widget-main -->

                <div class="toolbar clearfix">
                    <div>
                        <a href="{{ route('forgot-password') }}" class="forgot-password-link">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Bạn quên mật khẩu ?
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('register') }}" class="user-signup-link">
                            Đăng ký
                            <i class="ace-icon fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div><!-- /.widget-body -->
        </div><!-- /.login-box -->
    </div><!-- /.position-relative -->
    <div class="space-18"></div>
</div>

@endsection
