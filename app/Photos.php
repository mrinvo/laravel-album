<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{

		protected $fillable = [
        'album_id','filename','uploaded_by','video'
   ];

	public function albums() {
    return $this->belongsTo('App\Albums');
  }
  
  public function users() {
		return $this->belongsTo('App\User','uploaded_by');  	
  }
}
