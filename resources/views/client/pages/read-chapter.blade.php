@extends('client.index')
@section('read-chapter')
    <h1 style="text-align: center;">{{ $comics->COMIC_NAME }}</h1>
    <h2 style="text-align: center;">{{ $chapters->CHAPTER_NAME }}</h2>
    <div class="center sticky-top">
        <div class="btn-group">
            @isset($disabled)
                @if ($disabled == 'disabled-prev')
                    <button type="button" class="btn btn-primary" disabled }}><i class="fa-solid fa-caret-left"></i></button>
                @else
                    <a href="{{ route('read-chapter-prev', ['id' => $chapters->CHAPTER_ID,'comic_id' => $comics->COMIC_ID]) }}">
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i></button>
                    </a>
                @endif
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">{{ $chapters->CHAPTER_NAME }}</button>
                    <div class="dropdown-menu">
                        @foreach ($chapterAll as $item)
                            <a class="dropdown-item" href="{{ route('read-chapter', ['id' => $item->CHAPTER_ID]) }}">{{ $item->CHAPTER_NAME }}</a>
                        @endforeach
                    </div>
                </div>
                @if ($disabled == 'disabled-next')
                    <button type="button" class="btn btn-primary" disabled }}><i class="fa-solid fa-caret-right"></i></button>
                @else
                    <a href="{{ route('read-chapter-next', ['id' => $chapters->CHAPTER_ID,'comic_id' => $comics->COMIC_ID]) }}">
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-caret-right"></i></button>
                    </a>
                @endif
            @endisset
        </div>
    </div>
        
    <hr>
    @isset($typeComic)
        @foreach ($contents as $item)
        <div class="img-container scroll-chrome">
            <img src="{{ $item->GGDRIVE_URL }}" alt="" id="image_content">
        </div>
        @endforeach
    @endisset
    @isset($typeLightNovel)
    <div class="clearfix">
        {!! $contents->CONTENT_LIGHT_NOVEL !!}
        <div class="space-20"></div>
    </div>
    @endisset
    
@endsection