@extends('client.index')
@section('forgot-password')
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
                <div id="forgot-box" class="forgot-box widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header red lighter bigger">
                                <i class="ace-icon fa fa-key"></i>
                                Lấy lại mật khẩu
                            </h4>
                
                            <div class="space-6"></div>
                            <p>
                                Nhập email của bạn và để nhận hướng dẫn
                            </p>
                
                            <form>
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="email" class="form-control" placeholder="Email" />
                                            <i class="ace-icon fa fa-envelope"></i>
                                        </span>
                                    </label>
                
                                    <div class="clearfix">
                                        <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                            <i class="ace-icon fa fa-lightbulb-o"></i>
                                            <span class="bigger-110">Giửi cho tôi!</span>
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
                        </div><!-- /.widget-main -->
                
                        <div class="toolbar center">
                            <a href="{{ route('login') }}" class="back-to-login-link">
                                Quay lại trang đăng nhập
                                <i class="ace-icon fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div><!-- /.widget-body -->
                </div><!-- /.forgot-box -->
            </div>
        </div>
    </div>
    
    <div class="space-18"></div>
</div>        
@endsection


