<?php

namespace App\Models;


/**
 * Class Country
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $withCount = [
		'getAnime',
	];

	/**
	 * Country constructor.
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
