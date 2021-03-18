<?php


namespace App\Services;


use Cache;
use Carbon\Carbon;
use \Laravel\Jetstream\HasProfilePhoto;

/**
 * Trait UserModelTrait
 *
 * @package App\Services
 */
trait UserModelTrait
{
	use HasProfilePhoto;

	/**
	 * @return mixed
	 */
	public function getFavoritesCountAttribute()
	{
		return $this->attributes['favorites_count'] = $this->favorites()->count();
	}

	/**
	 * @return mixed
	 */
	public function getAnimeCountAttribute()
	{
		return $this->attributes['anime_count'] = $this->getAnime()->count();
	}

	/**
	 * @return mixed
	 */
	public function getCommentsCountAttribute()
	{
		return $this->attributes['comments_count'] = $this->getComments()->count();
	}

	/**
	 * @return mixed
	 */
	public function getCommentsReplyCountAttribute()
	{
		return $this->attributes['comments_reply_count'] = $this->getComments()->where('user_id', '>', 0)->count();
	}

	/**
	 * @return mixed
	 */
	public function getPMCountAttribute()
	{
		return $this->attributes['pm_count'] = $this->getPersonalMessageRecipient()->count();
	}

	/**
	 * @return bool
	 */
	public function getIsOnlineAttribute(): bool
	{
		return Cache::has('user-is-online-' . $this->id);
	}

	/**
	 * @param $value
	 *
	 * @return mixed
	 */
	public function setLastLoginsAttribute($value)
	{
		return $this->attributes['last_logins'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return mixed
	 */
	public function setCreatedAttribute($value)
	{
		return $this->attributes['created'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @return int
	 */
	public function getNotReadMessageAttribute(): int
	{
		return $this->getPersonalMessageRecipient()->where('is_read', '=', 0)->count();
	}

	/**
	 * Аватар по умолчанию
	 *
	 * @return string
	 */
	protected function defaultProfilePhotoUrl(): string
	{
		return '/images/no_avatar_lightstat.png';
	}
}