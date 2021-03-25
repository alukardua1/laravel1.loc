<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class YearAired
 *
 * @package App\Models
 */
class YearAired extends Model
{
	public array  $cacheTags   = ['year'];
	public string $cachePrefix = 'year_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [];

	/**
	 * YearAired constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getAnime(): BelongsTo
	{
    	return $this->belongsTo(Anime::class, 'id', 'aired_season')->latest();
    }
}
