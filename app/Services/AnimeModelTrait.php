<?php


namespace App\Services;


use Carbon\Carbon;

trait AnimeModelTrait
{

	use MutationTrait;
	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function setAiredAttribute($value)
	{
		return $this->attributes['aired'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function setReleasedAttribute($value)
	{
		return $this->attributes['released'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @return array
	 */
	public function getVoteAttribute()
	{
		return $this->votePlusMinus($this->getVote()->get());
	}

	/**
	 * @todo Временное решение придумать как изменить
	 */
	public function getCategoryAttribute()
	{
		return $this->categoryMutation($this->getCategory()->get());
	}

	public function setCommentsCountAttribute($value)
	{
		return $this->attributes['comments_count'] = $value;
	}
}