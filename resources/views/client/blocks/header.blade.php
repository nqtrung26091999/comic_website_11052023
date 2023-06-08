<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}"><i class="ace-icon fa fa-leaf green"></i> MÊ TRUYỆN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">
                        <button class="btn btn-danger navbar-btn btn-sm">Trang chủ</button>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <button class="btn btn-danger navbar-btn btn-sm">Fanpage</button>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <button class="btn btn-danger navbar-btn btn-sm" disabled>Lịch sử</button>
                    </a>
                </li>
                @if (!session('user'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <button class="btn btn-success navbar-btn btn-sm">Đăng nhập</button>
                    </a>
                </li>
                @endif
                
                @if(session('user'))
                    @if (session('user')->ACCOUNT_TYPE == 'ADMIN')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">
                            <button class="btn btn-info navbar-btn btn-sm">Quản lý</button>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('profile-user', ['id' => session('user')->USER_ID]) }}" style="margin-left: 20px;">
                            <span>
                                @if (session('user'))
                                    @if (session('user')->USER_AVATAR == null)
                                    <img src="{{ asset('user.png') }}" alt="" height="50px" width="50px">
                                    @else
                                    <img src="data:image/jpeg;base64,{{ session('user')->USER_AVATAR }}" alt="" height="50px" width="50px">
                                    @endif
                                @endif                            
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile-user', ['id' => session('user')->USER_ID]) }}" class="nav-link">
                            <span><strong>Xin chào, {{ session('user')->USERNAME }}</strong></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-4 bg-light border-bottom mb-4">
</header>
