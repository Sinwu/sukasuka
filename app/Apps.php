<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
    /**
 	* The attributes that are mass assignable.
 	*
 	* @var array
 	*/
	protected $fillable = [
		'url', 'icon_url', 'name', 'description'
    ];
    
}
