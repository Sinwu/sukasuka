<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable;

	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'birthday', 'active', 'admin', 'corporate', 'about', 'src', 'gender', 'sso_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token'
	];

	public function posts()
	{
		return $this->hasMany('App\Post');
	}

	public function activities()
	{
		return $this->hasMany('App\Activity');
	}

	public function NotificationsAsActor()
	{
		return $this->hasMany('App\Notification', 'id', 'actor_id');
	}

	public function NotificationsAsOwner()
	{
		return $this->hasMany('App\Notification', 'id', 'owner_id');
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
