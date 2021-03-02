<?php

namespace App\Models;


/**
 * Class MPAARating
 *
 * @package App\Models
 */
class MPAARating extends Model
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
		return $this->hasMany(Anime::class, 'rating_id');
	}
}
