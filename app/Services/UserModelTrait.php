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
	 * @return int
	 */
	public function getFavoritesCountAttribute(): int
	{
		return $this->attributes['favorites_count'] = $this->favorites()->count();
	}

	/**
	 * @return int
	 */
	public function getAnimeCountAttribute(): int
	{
		return $this->attributes['anime_count'] = $this->getAnime()->count();
	}

	/**
	 * @return int
	 */
	public function getCommentsCountAttribute(): int
	{
		return $this->attributes['comments_count'] = $this->getComments()->count();
	}

	/**
	 * @return int
	 */
	public function getCommentsReplyCountAttribute(): int
	{
		return $this->attributes['comments_reply_count'] = $this->getComments()->where('user_id', '>', 0)->count();
	}

	/**
	 * @return int
	 */
	public function getPMCountAttribute(): int
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
	 * @return string
	 */
	public function setLastLoginsAttribute($value): string
	{
		return $this->attributes['last_logins'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return mixed
	 */
	public function setCreatedAttribute($value): mixed
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