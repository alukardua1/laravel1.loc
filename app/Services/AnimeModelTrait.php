<?php


namespace App\Services;


use Carbon\Carbon;

/**
 * Trait AnimeModelTrait
 *
 * @package App\Services
 */
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
	public function setUpdateAttribute($value)
	{
		return $this->attributes['update'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function setCreateAttribute($value)
	{
		return $this->attributes['create'] = (new Carbon($value))->format('d.m.Y');
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
	 *
	 * @return string
	 */
	public function getCategoryAttribute()
	{
		return $this->categoryMutation($this->getCategory()->get());
	}

	/**
	 * @param $value
	 *
	 * @return mixed
	 */
	public function setCommentsCountAttribute($value)
	{
		return $this->attributes['comments_count'] = $value;
	}
}