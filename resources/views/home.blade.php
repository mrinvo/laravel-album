@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('message'))

    <div class="alert alert-success">{{ $message }}</div>

@endif
    <div class="row justify-content-center">
        	@foreach($albums as $album_id=>$album)
        		<div class="col-md-3 col-sm-6 col-12 p-1 m-1">
        			<div class="col-12">
        				<h2>
        					<a href="{{ route('photos.list',['id'=>$album_id]) }}">{{ $album['name'] }}</a>
        				</h2>
        			</div>
        			<div class="col-12">

        				<a href="{{ route('photos.list',['id'=>$album_id]) }}">
        					<img src="{{ $album['thumbnail'] }}" class="photo_thumb" />
                            <a href="" class="btn btn-primary">Edit</a>
                            <a href="{{ route('albums.destroy',$album_id) }}" class="btn btn-danger">Delete album</a>


        				</a>
        			</div>
        		</div>
        	@endforeach
        		<div class="col-md-3 col-sm-6 col-12 p-1 m-1">
        			<div class="col-12">
        				<h2>
        					<a href="{{ route('albums.create') }}">Add album</a>
        				</h2>
        			</div>
        			<div class="col-12">
        				<a href="{{ route('albums.create') }}">
        					<img src="{{ $add_thumbnail }}" class="photo_thumb" />
        				</a>
        			</div>
        		</div>
    </div>
</div>
@endsection
