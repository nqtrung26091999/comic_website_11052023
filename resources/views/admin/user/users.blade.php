@extends('admin.index')
@section('users')
<div>
    <h2>Manage users</h2>
    <hr>
    <a href="{{ route('admin.users.add') }}">
        <button class="btn btn-primary" type="button">Add User</button>
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
        <th scope="col">Full Name</th>
        <th scope="col">Type</th>
        <th scope="col">Email</th>
        <th scope="col">Gender</th>
        <th scope="col">Birthday</th>
        <th scope="col">Action</th>
        <th scope="col">Profile</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($allUsers as $item)
      <tr>
        <th scope="row">{{ $item->USER_ID }}</th>
        <td>{{ $item->FULLNAME }}</td>
        <td>{{ $item->ACCOUNT_TYPE }}</td>
        <td>{{ $item->EMAIL }}</td>
        <td>
          @if ($item->GENDER === 0)
            Male
          @elseif($item->GENDER === 1)
            Female
          @elseif($item->GENDER === 2)
              Other
          @endif
        </td>
        <td>{{ $item->BIRTHDAY }}</td>
        <td>
            <a href="{{ route('admin.users.delete', ['id'=>$item->USER_ID]) }}" class="glyphicon glyphicon-trash fa-2x"></a>
        </td>
        <td><a href="{{ route('admin.users.profile', ['id'=>$item->USER_ID]) }}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
      </tr>
      @endforeach
    </tbody>
</table>
@endsection   