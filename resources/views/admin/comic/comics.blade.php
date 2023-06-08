@extends('admin.index')
@section('comics')
@inject('model', 'App\Models\HoldCategory')
<div>
    <h2><strong>Manage comics</strong></h2>
    <hr>
    <a href="{{ route('admin.comics.add-comic') }}">
        <button class="btn btn-primary" type="button">Add comic</button>
    </a>
</div>

@if (session('msg-success'))
  <div class="space-6"></div>
  <div class="alert alert-success">{{session('msg-success')}}</div>
@endif
@if (session('msg-warning'))
  <div class="space-6"></div>
  <div class="alert alert-warning">{{session('msg-warning')}}</div>
@endif
@if (session('msg-danger'))
  <div class="space-6"></div>
  <div class="alert alert-danger">{{session('msg-danger')}}</div>
@endif
<hr>
<table class="table">
    <thead class="">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Cover image</th>
        <th scope="col">Comic Name</th>
        <th scope="col">Author</th>
        <th scope="col">Categories</th>
        <th scope="col">Short description</th>
        <th scope="col">Chapters</th>
        <th scope="col">Type</th>
        <th scope="col">Del</th>
        <th scope="col">Edit</th>
        <th scope="col">Add chapter</th>
      </tr>
    </thead>
    <tbody>
    @if (isset($allComics))
        @foreach ($allComics as $item)
        <tr>
        <th scope="row">{{ $item->COMIC_ID }}</th>
        <td><img src="data:image/jpeg;base64,{{ $item->COVER }}" alt="" id="cover" width="140" height="180"></td>
        <td><strong>{{ $item->COMIC_NAME }}</strong></td>
        <td>{{ $item->USER_ID }}</td>
        <td>
          @foreach ($model->getByIdComic($item->COMIC_ID) as $value)
            @if ($value->COMIC_ID == $item->COMIC_ID)
              <p><strong>{{ $value->HOLD_CATEGORY_NAME }}</strong></p>
            @endif
          @endforeach
        </td>
        <td style="width: 400px">{{ $item->SHORT_DESCRIPTION }}</td>
        <td style="width: 100px">
          <strong>
            <a href="{{ route('admin.chapters.manage-chapter', ['id' => $item->COMIC_ID]) }}">{{ $item->TOTAL_CHAPTERS }} chapters</a>
          </strong>
        </td>
        <td>{{ $item->TYPE }}</td>
        <td>
            <a href="{{ route('admin.comics.delete-comic', ['id'=>$item->COMIC_ID]) }}" class="glyphicon glyphicon-trash fa-2x"></a>
        </td>
        <td><a href="{{ route('admin.comics.edit-comic', ['id'=>$item->COMIC_ID]) }}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
        <td><a href="{{ route('admin.chapters.add-chapter', ['id' => $item->COMIC_ID, 'chapter' => $item->TOTAL_CHAPTERS + 1]) }}" title="Add chapter"><i class="ace-icon glyphicon glyphicon-plus fa-2x"></i></a></td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
@endsection