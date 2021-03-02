<?php

namespace App\Models;


/**
 * Class Studio
 *
 * @package App\Models
 */
class Studio extends Model
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getAnime()
	{
		return $this->belongsToMany(Anime::class);
	}
}
