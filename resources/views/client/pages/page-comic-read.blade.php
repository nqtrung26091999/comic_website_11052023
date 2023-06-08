@extends('client.index')
@section('comic-detail')
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-sm-3"><img class="img-fluid rounded mb-4 mb-lg-0" src="data:image/jpeg;base64,{{ $comics->COVER }}"
                alt="..." /></div>
        <div class="col-lg-5">
            <h2 class="font-weight-light">{{ $comics->COMIC_NAME }}</h2>
            <strong><h3>Số tập: {{ $comics->TOTAL_CHAPTERS }}</h3></strong>
            <br>
            <strong>
                <h3>Thể loại:
                    @foreach ($categories as $item)
                    <a href="{{ route('search-category', ['id' => $item->CATEGORY_ID]) }}"><button class="btn btn-primary btn-sm">{{ $item->HOLD_CATEGORY_NAME }}</button></a>
                    @endforeach
                </h3>
            </strong>
            <hr>
            <p><strong>Nội dung:</strong> {{ $comics->SHORT_DESCRIPTION }}</p>
        </div>
        @if (session('user'))
        <input type="hidden" name="user_id" value="{{ session('user')->USER_ID }}">
        @endif
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Chapter</th>
                <th>Ngày đăng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chapters as $item)
            <tr>
                <td>
                    <a href="{{ route('read-chapter', ['id' => $item->CHAPTER_ID]) }}" style="text-decoration: none;">
                        {{ $item->CHAPTER_NAME }}
                    </a>
                </td>
                <td>{{ $item->CREATE_AT }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
