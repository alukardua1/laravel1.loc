<?php

namespace App\Models;


class Translate extends Model
{
	protected $withCount = [
		'getAnime',
	];
	/**
	 * MPAARating constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	public function getAnime()
	{
		return $this->belongsToMany(Anime::class);
	}
}
