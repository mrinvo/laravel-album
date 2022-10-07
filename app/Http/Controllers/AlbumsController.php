<?php

namespace App\Http\Controllers;

use App\Albums;
use App\Http\Controllers\PhotosController;
use App\Photos;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$albums=Albums::orderBy('last_updated','desc')->get()->all();
    	return($albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('album-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    		$input=$request->all();
        Albums::create($input);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function show(Albums $albums)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function edit(Albums $albums)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Albums $albums)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $albums_photos = Photos::where('album_id',$id)->get();

        if($albums_photos->count() == 0){
            Albums::where("id", $id)->delete();
            $message = 'empty album has been deleted successfly';
            return back()->with($message);
        }
        else{
            return redirect('choose');
        }

        //
    }

    public static function getAlbumName($id) {
    	if($id>0) {
    		return Albums::find($id)->name;
    	}
    	return false;
    }

    public function choose($id){

        return view('album-choose');
    }
}
