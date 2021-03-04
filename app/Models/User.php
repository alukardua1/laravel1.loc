<?php

namespace App\Models;

use App\Services\MutationTrait;
use Config;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
	use MutationTrait;

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
	protected $appends = [
		'profile_photo_url',
		'getGroup',
	];
	protected $withCount = [
		'favorites',
		'getAnime',
	];

	protected $cacheFor;

	/**
	 * User constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->cacheFor = Config::get('secondConfig.cache_time');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getGroup(): BelongsTo
	{
		return $this->belongsTo(Group::class, 'group_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getAnime(): HasMany
	{
		return $this->hasMany(Anime::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function favorites(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class, 'favorites')->withTimeStamps();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function vote(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class, 'votes')->withTimestamps();
	}
}
