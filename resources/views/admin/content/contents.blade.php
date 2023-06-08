@extends('admin.index')
@section('contents')
<div>
    <h2><strong>Manage contents</strong></h2>
    <hr>
    <br>
    <label for="">Comic Name: <strong>{{ $comicDetails->COMIC_NAME }}</strong></label>
    <br>
    <label for="">Type: <strong>{{ $comicDetails->TYPE }}</strong></label>
    <br>
    <label for="">Chapter: <strong>{{ $chapterName }}</strong></label>
    <br>
    <img src="data:image/jpeg;base64,{{ $comicDetails->COVER }}" alt=""  width="130" height="170">
    <hr>
    <a href="{{ route('admin.contents.add-content', ['id' => $id]) }}">
        <button class="btn btn-primary" type="button">Add content</button>
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
        <th scope="col">Name</th>
        <th scope="col">Content</th>
        <th scope="col">Del</th>
      </tr>
    </thead>
    <tbody>
      @if($type == 'Comic')
        @foreach ($dataContentNew as $item)
        <tr>
          <td>{{ $item->CONTENT_ID }}</td>
          <td>{{ $item->FILE_PATH }}</td>
          <td>
            <div id="wrap">
              <img src="{{ $item->GGDRIVE_URL }}" alt="" height="100px" width="200px">
            </div>
          </td>
          <td><a href="{{ route('admin.contents.delete-content', ['id' => $item->CONTENT_ID]) }}" class="glyphicon glyphicon-trash fa-2x"></a></td>
        </tr>
        @endforeach
      @endif
          
      @if($type == 'Light-Novel')
        @foreach ($dataContentNew as $item)
        <tr>
          <td>{{ $item->CONTENT_ID }}</td>
          <td>None</td>
          <td style="" id="content_LN">{{ $item->CONTENT_LIGHT_NOVEL }}</td>
          <td><a href="{{ route('admin.contents.delete-content', ['id' => $item->CONTENT_ID]) }}" class="glyphicon glyphicon-trash fa-2x"></a></td>
        </tr>
        @endforeach
      @endif
      <style>
        #content_LN {
          text-overflow: ellipsis;
          overflow: hidden;
          white-space: nowrap;
          max-width: 500px;
        }
      </style>
    </tbody>
</table>
@endsection