<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

	public $cacheTags = ['country'];
	public $cachePrefix = 'country_';

	/**
	 * Country constructor.
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
	public function getAnime(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class)->latest();
	}
}
