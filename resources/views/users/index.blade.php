@extends('layouts.app')

@section('content')

@if(Session::has('deleted_user'))
<p class="alert alert-success">{{session('deleted_user')}}</p>
@endif
<div class="container">
<h1>Users</h1>
<a href="{{route("user.create")}}" class="btn btn-primary float-right mb-4">Create user</a>
<table class="table sorting__table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
   </thead>
   <tbody>
  
  @if($users)
  
  	@foreach($users as $user)
  	
    <tr>
      <td>{{$user->id}}</td>
      <td><a href="{{route('user.edit', $user->id)}}">{{$user->name}}</a></td>
      <td>{{$user->email}}</td>
      <td>{{$user->created_at->diffForHumans()}}</td>
      <td>{{$user->updated_at->diffForHumans()}}</td>
    </tr>
    
  	@endforeach
  @endif
  
  </tbody>
</table>
</div>

@endsection

@section('customJS')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
    <script src="{{asset('admin/js/sorting_tables.js')}}"></script>
@endsection