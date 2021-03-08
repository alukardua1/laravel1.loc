<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
	public $cacheTags = ['studio'];
	public $cachePrefix = 'studio_';
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
	public function getAnime(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class)->latest();
	}
}
