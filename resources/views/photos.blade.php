@extends('layouts.app')

@section('header_scripts')
<link href="{{ asset('assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
@endsection

@section('content')
<div class="container">
		<div class="row">
			<div class="col-12">
					<h1>{{ $album['name'] }}</h1>
				</div>
		</div>
    <div class="row">
        <div class="col-12 text-right">
            <a href="{{route('home') }}" class="btn btn-primary"">&lt;&lt; Back to albums</a>
        </div>
    </div>
    <div class="row justify-content-center">
        	@foreach($photos as $photo_id=>$photo)
        		<div class="col-md-3 col-sm-6 col-12 p-1 m-1">
        			<div class="col-12 thumb_photospace">
        				<a href="{{ url('/').$photo['fullsize'] }}" data-fancybox="gallery">
        					<img src="{{ url('/').$photo['thumb'] }}" class="photo_thumb" />
        				</a>
        			</div>
        		</div>
        	@endforeach
        		<div class="col-md-3 col-sm-6 col-12 p-1 m-1">
        			<div class="col-12">
        				<a href="{{ route('photos.createupload',['id'=>$album['id']]) }}">
        					<img src="{{ $add_thumbnail }}" class="photo_thumb" />
        				</a>
        			</div>
        		</div>
    </div>
    <div class="row justify-content-center">
    	{!! $brute_photos->render() !!}
    </div>
</div>

@endsection


@section('header_scripts')
<script type="text/javascript">
$('[data-fancybox="gallery"]').fancybox({
	// Options will go here
});
</script>
@endsection
