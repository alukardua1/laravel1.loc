<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;

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
	public $cacheTags = ['mpaa'];
	public $cachePrefix = 'mpaa_';
	/**
	 * MPAARating constructor.
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
	public function getAnime(): HasMany
	{
		return $this->hasMany(Anime::class, 'rating_id')->latest();
	}
}
