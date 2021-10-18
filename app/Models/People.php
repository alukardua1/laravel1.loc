<?php

namespace App\Models;

class People extends Model
{
	public array  $cacheTags   = ['people'];
	public string $cachePrefix = 'people_';

	protected $fillable = [
	];

	/**
	 * OtherLink constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	public function getAnime()
	{
		return $this->hasMany(Anime::class)->latest();
	}
}
