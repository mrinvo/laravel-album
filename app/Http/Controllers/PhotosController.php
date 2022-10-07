<?php

namespace App\Http\Controllers;

use Image;
use App\Photos;
use App\Http\Controllers\AlbumsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{

	  public static $thumb_folder='/photos/thumbs/';
		public static $bigger_folder='/photos/bigger/';
		public static $fullsize_folder='/photos/fullsize/';
		public static $video_folder='/photos/videos/';
		private $max_thumb_width=200;
		private $max_thumb_height=200;
		private $max_bigger_width=700;
		private $max_bigger_height=700;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $folders=array(
            public_path().'/photos/thumbs/',
            public_path().'/photos/bigger/',
            public_path().'/photos/fullsize/',
            public_path().'/photos/videos/'
        );
        foreach($folders as $folder) {
            if(!\File::exists($folder)) {
                \File::makeDirectory($folder, $mode = 0777, true, true);
            }
        }
    		$photos=array();
        if($id>0) {
        	$brute_photos = Photos::where('album_id',$id)->paginate(20);
					$array_photos=$brute_photos->all();
        	foreach($array_photos as $photo) {
	    			$photos[$photo->id]['name']=$photo->filename;
	    			$extension = pathinfo(public_path().self::$thumb_folder.$photo->filename, PATHINFO_EXTENSION);
	    			if($extension=='mp4') {
	    				$photos[$photo->id]['thumb']=self::$thumb_folder.'play.jpg';
	    				$photos[$photo->id]['fullsize']=self::$video_folder.$photo->filename;
	    			} else {
	    				$photos[$photo->id]['thumb']=self::$thumb_folder.$photo->filename;
	    				$photos[$photo->id]['fullsize']=self::$fullsize_folder.$photo->filename;
	    			}
	    		}

        }
        $album_name = AlbumsController::getAlbumName($id);
        $album['name']=$album_name;
        $album['id']=$id;
				$add_thumbnail=self::getAddImage();
        return view('photos',compact('brute_photos','photos','album','add_thumbnail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $album_name = AlbumsController::getAlbumName($id);
        $album['name']=$album_name;
        $album['id']=$id;
        return view('photos-upload',compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    		$user = Auth::user();
    		$input=$request->all();
        $image = $request->file('file');
        $imageName = $input['album_id'].'-'.$image->getClientOriginalName();
        $imageExt=$image->getClientOriginalExtension();
        if($imageExt!='mp4') {
        $destinationPath = public_path().self::$thumb_folder;
        $img = Image::make($image->path());
        $img->resize($this->max_thumb_width, $this->max_thumb_height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$imageName);

        $destinationPath = public_path().self::$bigger_folder;
        unset($img);
        $img = Image::make($image->path());
        $img->resize($this->max_bigger_width, $this->max_bigger_height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$imageName);

        	$image->move(public_path().self::$fullsize_folder,$imageName);
   			} else {
   				$image->move(public_path().self::$video_folder,$imageName);
   			}
   			$photo=new Photos();
   			$photo->album_id=$input['album_id'];
   			$photo->filename=$imageName;
   			$photo->uploaded_by=$user->id;
   			if($imageExt=='mp4') {
   				$photo->video=1;
   			} else {
   				$photo->video=0;
   			}
   			$photo->save();

        return response()->json(['success'=>$imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photos  $photos
     * @return \Illuminate\Http\Response
     */
    public function show(Photos $photos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photos  $photos
     * @return \Illuminate\Http\Response
     */
    public function edit(Photos $photos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photos  $photos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photos $photos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photos  $photos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photos $photos)
    {
        //
    }

    public static function getNoImage() {
    	return (url('/').self::$thumb_folder.'no-image.svg');
    }

    public static function getAddImage() {
    	return (url('/').self::$thumb_folder.'plus-icon.jpg');
    }

    public static function getThumbnailLink($image_id) {
    	$photo=Photo::find($image_id);
    	if(isset($photo->id) || $photo->id<1) {
    		return self::getNoImage();
    	} else {
    		return (url('/').self::$thumb_folder.$image->name);
    	}
    }

    public function gallery($id) {
    		$photos=array();
        if($id>0) {
        	$brute_photos = Photos::where('album_id',$id)->get();
					$array_photos=$brute_photos->all();
        	foreach($array_photos as $photo) {
	    			$photos[$photo->id]['name']=$photo->filename;
	    			$photos[$photo->id]['thumb']=self::$thumb_folder.$photo->filename;
	    		}
        }
        $album_name = AlbumsController::getAlbumName($id);
        $album['name']=$album_name;
        $album['id']=$id;
				$add_thumbnail=self::getAddImage();
        return view('photos-gallery',compact('brute_photos','photos','album','add_thumbnail'));
    }
}
