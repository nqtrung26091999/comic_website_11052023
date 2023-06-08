@extends('admin.index')
@section('chapters')
@inject('model', 'App\Models\HoldCategory')
<div>
    <h2><strong>{{ $title }}</strong></h2>
    <label for="">Comic Name:{{ $comicDetails->COMIC_NAME }}</label>
    <br>
    <label for="">Type:{{ $comicDetails->TYPE }}</label>
    <br>
    <img src="data:image/jpeg;base64,{{ $comicDetails->COVER }}" alt=""  width="130" height="170">
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
        <th scope="col">Chapter Name</th>
        <th scope="col">Total Image</th>
        <th scope="col">Date Created</th>
        <th scope="col">Date Updated</th>
        <th scope="col">Del</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($allChapters as $item)
      <tr>
        <td>{{ $item->CHAPTER_ID }}</td>
        <td><a href="{{ route('admin.contents.manage-content', ['id' => $item->CHAPTER_ID]) }}">{{ $item->CHAPTER_NAME }}</a></td>
        <td>1</td>
        <td>{{ $item->CREATE_AT }}</td>
        <td>{{ $item->UPDATE_AT }}</td>
        <td><a href="{{ route('admin.chapters.delete-chapter', ['id' => $item->CHAPTER_ID]) }}" class="glyphicon glyphicon-trash fa-2x"></a></td>
        <td><a href="{{ route('admin.chapters.edit-chapter', ['id' => $item->CHAPTER_ID]) }}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
      </tr>
      @endforeach    
    </tbody>
</table>
@endsection