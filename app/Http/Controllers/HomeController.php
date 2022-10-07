<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PhotosController;
use App\Http\Controllers\AlbumsController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$albums_object=new AlbumsController();
    	$brute_albums = $albums_object->index();
    	
    	$albums=array();
    	foreach($brute_albums as $album) {
    		$albums[$album->id]['name']=$album->name;
    		if($album->photo_id>0) {
    			$albums[$album->id]['thumbnail']=PhotosController::getThumbnailLink($album->photo_id);
    		} else {
    			$albums[$album->id]['thumbnail']=PhotosController::getNoImage();
    		}
    	}
    	
    	$add_thumbnail=PhotosController::getAddImage();
    	
    	return view('home',compact('albums','add_thumbnail'));
    }
}
