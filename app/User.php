<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class User extends Authenticatable
{
	use Notifiable;

	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'birthday', 'active'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function posts()
	{
			return $this->hasMany('App\Post');
	}

	protected static function boot()
	{
		parent::boot();
		
		static::creating(function ($model) {
				try {
						$model->id = Uuid::uuid4()->toString();
				} catch (UnsatisfiedDependencyException $e) {
						abort(500, $e->getMessage());
				}
		});
	}
}
