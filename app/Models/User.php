<?php

namespace App\Models;

use App\Services\MutationTrait;
use App\Services\UserModelTrait;
use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
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
	use UserModelTrait;
	use HasApiTokens;
	use HasFactory;
	use HasTeams;
	use Notifiable;
	use TwoFactorAuthenticatable;
	use QueryCacheable;
	use MutationTrait;


	protected $cacheFor;
	public $cacheTags = ['user'];
	public $cachePrefix = 'user_';

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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getGroup()
	{
		return $this->belongsTo(Group::class, 'group_id', 'id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getAnime()
	{
		return $this->hasMany(Anime::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function favorites()
	{
		return $this->belongsToMany(Anime::class, 'favorites')->latest()->withTimeStamps();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function vote()
	{
		return $this->belongsToMany(Anime::class, 'votes')->latest()->withTimestamps();
	}

	public function getPersonalMessageAuthor()
	{
		return $this->hasMany(PersonalMessage::class, 'author_id')->latest();
	}

	public function getPersonalMessageRecipient()
	{
		return $this->hasMany(PersonalMessage::class, 'recipient_id')->latest();
	}

	public function getCountry()
	{
		return $this->hasOne(Country::class, 'id', 'country_id')->latest();
	}

	public function getComments()
	{
		return $this->belongsTo(Comment::class, 'id', 'author_id')->latest();
	}
}
