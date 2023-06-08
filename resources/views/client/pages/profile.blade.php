@extends('client.index')
@section('profile-user')
    <div class="tab-content no-border padding-24">
        @if (session('user'))
            <div id="home" class="tab-pane in active">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 center">
                        <span class="profile-picture">
                            <img class="editable img-responsive" alt="Alex's Avatar" id="avatar2"
                                src="data:image/jpeg;base64, {{ session('user')->USER_AVATAR }}" />
                        </span>
                        <div class="center red">
                            <strong>Avatar</strong>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-9">

                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Tên tài khoản </div>

                                <div class="profile-info-value">
                                    <span>{{ session('user')->USERNAME }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Họ tên </div>

                                <div class="profile-info-value">
                                    <span>{{ session('user')->FULLNAME }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Sinh nhật </div>

                                <div class="profile-info-value">
                                    <span>{{ date('d-M-Y', strtotime(session('user')->BIRTHDAY)) }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Ngày tham gia </div>

                                <div class="profile-info-value">
                                    <span>{{ date('d-M-Y', strtotime(session('user')->CREATE_AT)) }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Giới tính </div>

                                <div class="profile-info-value">
                                    @if (session('user')->GENDER == 0)
                                        Male <i class="fa-solid fa-mars"></i>
                                    @endif
                                    @if (session('user')->GENDER == 1)
                                        Female <i class="fa-solid fa-venus"></i>
                                    @endif
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Email </div>

                                <div class="profile-info-value">
                                    <span>{{ session('user')->EMAIL }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="hr hr-8 dotted"></div>

                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row col-sm-8">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Truyện đã đọc</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $item)
                                <tr>
                                    <td>
                                        <div
                                            class="alert alert-light alert-dismissible d-flex align-items-center col-sm-12">
                                            <div class="col-sm-1">
                                                <img src="data:image/jpeg;base64, {{ $item->COVER }}" alt=""
                                                    height="65px" width="50px">
                                            </div>
                                            <div class="col-sm-9">
                                                <span>{{ $item->COMIC_NAME }}</span>
                                            </div>
                                            <div class="">
                                                <span>{{ $item->CHAPTER_NAME }}</span>
                                            </div>
                                            <a href="{{ route('remove-history', ['id' => $item->CHAPTER_ID]) }}">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div><!-- /#home -->
        @endif
    </div>
@endsection
