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
	public function setAiredAttribute($value): string
	{
		return $this->attributes['aired'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function setUpdateAttribute($value): string
	{
		return $this->attributes['update'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function setCreateAttribute($value): string
	{
		return $this->attributes['create'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function setReleasedAttribute($value): string
	{
		return $this->attributes['released'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @return array
	 */
	public function getVoteAttribute(): array
	{
		return $this->votePlusMinus($this->getVote()->get());
	}

	/**
	 * @return string
	 * @todo Временное решение придумать как изменить
	 *
	 */
	public function getCategoryAttribute(): string
	{
		return $this->categoryMutation($this->getCategory()->get());
	}

	/**
	 * @param $value
	 *
	 * @return mixed
	 */
	public function setCommentsCountAttribute($value): mixed
	{
		return $this->attributes['comments_count'] = $value;
	}
}