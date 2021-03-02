<?php

namespace App\Models;

/**
 * Class Quality
 *
 * @package App\Models
 */
class Quality extends Model
{
	protected $withCount = [
		'getAnime',
	];
	/**
	 * Quality constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getAnime()
	{
		return $this->belongsToMany(Anime::class);
	}
}
