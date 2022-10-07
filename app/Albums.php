<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
	 protected $fillable = [
        'name'
   ];
   
   
	public function photos() {
    	return $this->hasMany('App\Photos');
  }
  
   
}
