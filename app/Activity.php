<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
 	* The attributes that are mass assignable.
 	*
 	* @var array
 	*/
	protected $fillable = [
		'post_id', 'comment_id', 'like_id', 'type'
	];
	
}
