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
	public array  $cacheTags   = ['channel'];
	public string $cachePrefix = 'channel_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [];

	protected $touches = ['getAnime'];
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
