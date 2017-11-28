<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppParams extends Model
{
    /**
 	* The attributes that are mass assignable.
 	*
 	* @var array
 	*/
	protected $fillable = [
		'apps_id', 'type', 'name', 'value'
	];
    
    public function apps()
	{
		return $this->belongsTo('App\Apps');
	}
}
