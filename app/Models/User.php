<?php

namespace App\Models;

use Config;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens;
	use HasFactory;
	use HasProfilePhoto;
	use HasTeams;
	use Notifiable;
	use TwoFactorAuthenticatable;
	use QueryCacheable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'login',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'two_factor_recovery_codes',
		'two_factor_secret',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'profile_photo_url',
		'getGroup',
	];

	protected $withCount = [
		'favorites',
		'getAnime',
	];

	protected $cacheFor;

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->cacheFor = Config::get('secondConfig.cache_time');
	}

	public function getGroup()
	{
		return $this->belongsTo(Group::class, 'group_id', 'id');
	}

	public function getAnime()
	{
		return $this->hasMany(Anime::class);
	}

	public function favorites()
	{
		return $this->belongsToMany(Anime::class, 'favorites')->withTimeStamps();
	}

	public function vote()
	{
		return $this->belongsToMany(Anime::class, 'votes')->withTimestamps();
	}
}
