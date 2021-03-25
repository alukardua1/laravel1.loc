<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Quality
 *
 * @package App\Models
 */
class Quality extends Model
{
	public array  $cacheTags   = ['quality'];
	public string $cachePrefix = 'quality_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [];

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
	public function getAnime(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class)->latest();
	}
}
