<?php

namespace App\Models;

/**
 * Class Channel
 *
 * @package App\Models
 */
class Channel extends Model
{
	protected $withCount = [
		'getAnime',
	];
	/**
	 * Channel constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getAnime()
	{
		return $this->hasMany(Anime::class);
	}
}
