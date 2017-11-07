<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /**
 	* The attributes that are mass assignable.
 	*
 	* @var array
 	*/
	protected $fillable = [
		'content', 'type', 'destination', 'src'
	];
    
  public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function likes()
	{
		return $this->hasMany('App\Like');
	}

	public function activities()
	{
		return $this->hasMany('App\Activities');
	}
}
