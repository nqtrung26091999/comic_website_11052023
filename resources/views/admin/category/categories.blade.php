@extends('admin.index')
@section('categories')
<div>
    <h2><strong>Manage categories</strong></h2>
    <hr>
    <a href="{{ route('admin.categories.add-category') }}">
        <button class="btn btn-primary" type="button">Add Category</button>
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
        <th scope="col">Category Name</th>
        <th scope="col">Description</th>
        <th scope="col">Del</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
    @if (isset($allCate))
        @foreach ($allCate as $item)
        <tr>
        <th scope="row">{{ $item->CATEGORY_ID }}</th>
        <td>{{ $item->CATEGORY_NAME }}</td>
        <td>{{ $item->CATEGORY_DESCRIPTION }}</td>
        <td>
            <a href="{{ route('admin.categories.delete-category', ['id'=>$item->CATEGORY_ID]) }}" class="glyphicon glyphicon-trash fa-2x"></a>
        </td>
        <td><a href="{{ route('admin.categories.edit-category', ['id'=>$item->CATEGORY_ID]) }}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
        </tr>
        @endforeach
    @endif
      
    </tbody>
</table>
@endsection