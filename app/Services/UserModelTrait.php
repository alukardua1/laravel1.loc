<?php


namespace App\Services;


use Cache;
use Carbon\Carbon;
use \Laravel\Jetstream\HasProfilePhoto;

trait UserModelTrait
{
	use HasProfilePhoto;

	public function getFavoritesCountAttribute()
	{
		return $this->attributes['favorites_count'] = $this->favorites()->count();
	}

	public function getAnimeCountAttribute()
	{
		return $this->attributes['anime_count'] = $this->getAnime()->count();
	}

	public function getCommentsCountAttribute()
	{
		return $this->attributes['comments_count'] = $this->getComments()->count();
	}

	public function getCommentsReplyCountAttribute()
	{
		return $this->attributes['comments_reply_count'] = $this->getComments()->where('user_id', '>', 0)->count();
	}

	public function getPMCountAttribute()
	{
		return $this->attributes['pm_count'] = $this->getPersonalMessageRecipient()->count();
	}

	public function getisOnlineAttribute()
	{
		return Cache::has('user-is-online-' . $this->id);
	}

	public function setLastLoginsAttribute($value)
	{
		return $this->attributes['last_logins'] = (new Carbon($value))->format('d.m.Y');
	}

	public function setCreatedAttribute($value)
	{
		return $this->attributes['created'] = (new Carbon($value))->format('d.m.Y');
	}

	public function getNotReadMessageAttribute()
	{
		return $this->getPersonalMessageRecipient()->where('is_read', '=', 0)->count();
	}

	/**
	 * Аватар по умолчанию
	 *
	 * @return string
	 */
	protected function defaultProfilePhotoUrl()
	{
		return '/images/no_avatar_lightstat.png';
	}
}