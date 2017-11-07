<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  /**
 	* The attributes that are mass assignable.
 	*
 	* @var array
 	*/
	protected $fillable = [
		'user_id', 'post_id', 'liked'
  ];
    
  public function post()
	{
		return $this->belongsTo('App\Post');
	}
}
