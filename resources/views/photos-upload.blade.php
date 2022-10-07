@extends('layouts.app')

@section('header_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
@endsection

@section('content')
<div class="container">

    <h3 class="jumbotron">Add Photos to {{$album['name']}}</h3>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

  <form method="post" action="{{ route('photos.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
        @csrf
        <input type="hidden" name="album_id" value="{{ $album['id'] }}" />
  </form>
  <div class="col-12 mt-3">
  	<a href="{{ route('photos.list',['id'=>$album['id']]) }}" class="btn btn-primary">Back to album</a>
  </div>
</div>

@endsection

@section('footer_scripts')
    <script type="text/javascript">
				var csrf = $('meta[name=_token]').attr('content');

        $.ajaxSetup({
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', csrf);
            }
        });
        Dropzone.options.dropzone =
        {
            maxFilesize: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.mp4",
            addRemoveLinks: true,
            timeout: 60000,
            params: {'album_id':"{{ $album['id']}}",'csrf':csrf}
        };
    </script>
@endsection
