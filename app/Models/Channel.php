<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

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

	public $cacheTags = ['channel'];
	public $cachePrefix = 'channel_';
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
	public function getAnime(): HasMany
	{
		return $this->hasMany(Anime::class)->latest();
	}
}
