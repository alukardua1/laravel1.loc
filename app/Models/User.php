<?php

namespace App\Models;

use App\Services\MutationTrait;
use App\Services\UserModelTrait;
use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Rennokki\QueryCache\Traits\QueryCacheable;

class User extends Authenticatable
{
	use UserModelTrait;
	use HasApiTokens;
	use HasFactory;
	use HasTeams;
	use Notifiable;
	use TwoFactorAuthenticatable;
	use QueryCacheable;
	use MutationTrait;
	use SoftDeletes;

	protected mixed $cacheFor;

	public array  $cacheTags   = ['user'];
	public string $cachePrefix = 'user_';

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
		'last_login',
		'description',
		'signature',
		'city',
		'country_id',
		'profile_photo_path',
		'hide_email',
		'allow_mail',
		'comments_reply_subscribe',
		'anime_subscribe',
		'blocked',
		'blocked_at',
		'birthday',
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
	protected $casts   = [
		'email_verified_at' => 'datetime',
	];
	protected $appends = [
		'getGroup',
	];

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
	 * @return bool
	 */
	public function isAdmin(): bool
	{
		return $this->getGroup->is_dashboard === 1;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getGroup(): BelongsTo
	{
		return $this->belongsTo(Group::class, 'group_id', 'id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getAnime(): HasMany
	{
		return $this->hasMany(Anime::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function favorites(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class, 'favorites')->latest()->withTimeStamps();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function vote(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class, 'votes')->latest()->withTimestamps();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getPersonalMessageAuthor(): HasMany
	{
		return $this->hasMany(PersonalMessage::class, 'author_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getPersonalMessageRecipient(): HasMany
	{
		return $this->hasMany(PersonalMessage::class, 'recipient_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getCountry(): HasOne
	{
		return $this->hasOne(Country::class, 'id', 'country_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getComments(): BelongsTo
	{
		return $this->belongsTo(Comment::class, 'id', 'author_id')->latest();
	}
}
