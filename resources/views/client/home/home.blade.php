@extends('client.index')
@section('home')
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <div class="row">
                @isset($comics)
                    @foreach ($comics as $item)
                        <div class="col-lg-4">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="data:image/jpeg;base64,{{ $item->COVER }}"
                                        alt="..." height="300px" width="100px" /></a>
                                <div class="card-body">
                                    <div class="small text-muted">Ngày đăng: {{ date('d-M-y', strtotime($item->CREATE_AT)) }}
                                    </div>
                                    <h6 class="card-title h6"
                                        style="
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                        white-space: nowrap;
                                        ">
                                        <strong title="{{ $item->COMIC_NAME }}">
                                            <a style="
                                        text-decoration: none;
                                        "
                                                href="{{ route('read-comic', ['id' => $item->COMIC_ID]) }}">{{ $item->COMIC_NAME }}</a>
                                        </strong>
                                    </h6>
                                    <h6 class="red"><strong>Loại truyện: {{ $item->TYPE }}</strong></h6>
                                    <h6><strong>Số chapter: {{ $item->TOTAL_CHAPTERS }}</strong></h6>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('read-comic', ['id' => $item->COMIC_ID]) }}">Đọc truyện</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Pagination-->
                    <div class="center">
                        {{ $comics->links() }}
                    </div>
                @endisset
            </div>

        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">TÌm kiếm</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..."
                            aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Thể loại</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($categories as $items)
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <strong>
                                            <a href="{{ route('search-category', ['id' => $items->CATEGORY_ID]) }}"
                                                style="text-decoration: none;">{{ $items->CATEGORY_NAME }}</a>
                                        </strong>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Lịch sử đọc truyện</div>
                <div class="card-body overflow-scroll" style="max-height: 584px;">
                    @if (isset($histories))
                        @foreach ($histories as $item)
                        <div class="row col-sm-12 ms-1">
                            <div
                                class="alert alert-secondary alert-dismissible d-flex align-items-center col-sm-11">
                                <div class="col-sm-2">
                                    <img src="data:image/jpeg;base64, {{ $item->COVER }}" alt=""
                                        height="55px" width="40px">
                                </div>
                                <div class="col-sm-7"  style="
                                text-overflow: ellipsis;
                                overflow: hidden;
                                white-space: nowrap;
                                ">
                                    <a href="{{ route('read-chapter', ['id' => $item->CHAPTER_ID]) }}" class="text-decoration-none">
                                        <strong>
                                            <span class="small">{{ $item->COMIC_NAME }}</span>
                                        </strong>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <span>{{ $item->CHAPTER_NAME }}</span>
                                </div>
                                <a href="{{ route('remove-history', ['id' => $item->CHAPTER_ID]) }}">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection
