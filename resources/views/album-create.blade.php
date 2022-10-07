@extends('layouts.app')

@section('content')
<div class="container">
       
    <h3>Add Album</h3>
<form method="post" action="{{ route('albums.store')}}">
  {{csrf_field()}}

        <div class="input-group control-group increment" >
          <input type="text" name="name" class="form-control" placeholder="Name">
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

  </form>        
  </div>
  
@endsection