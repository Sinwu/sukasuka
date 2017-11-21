<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
 	* The attributes that are mass assignable.
 	*
 	* @var array
 	*/
	protected $fillable = [
		'actor_id', 'owner_id', 'post_id', 'action', 'read'
    ];
    
    public function actor()
	{
		return $this->belongsTo('App\User', 'actor_id');
    }
    
    public function owner()
	{
		return $this->belongsTo('App\User', 'owner_id');
    }
    
    public function post()
	{
		return $this->belongsTo('App\Post');
	}
}
