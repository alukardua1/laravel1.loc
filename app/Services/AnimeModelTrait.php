<?php

namespace App\Services;

use Carbon\Carbon;

trait AnimeModelTrait
{

	use MutationTrait;

	/**
	 * @param  string  $value
	 *
	 * @return string
	 */
	public function setAiredAttribute(string $value): string
	{
		return $this->attributes['aired'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param  string  $value
	 *
	 * @return string
	 */
	public function setUpdateAttribute(string $value): string
	{
		return $this->attributes['update'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param  string  $value
	 *
	 * @return string
	 */
	public function setCreateAttribute(string $value): string
	{
		return $this->attributes['create'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param  string  $value
	 *
	 * @return string
	 */
	public function setReleasedAttribute(string $value): string
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
	 * @param  int  $value
	 *
	 * @return int
	 */
	public function setCommentsCountAttribute(int $value): int
	{
		return $this->attributes['comments_count'] = $value;
	}
}