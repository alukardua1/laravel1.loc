<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class YearAired extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['year'];
	public string $cachePrefix = 'year_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [
		'title',
	];

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
