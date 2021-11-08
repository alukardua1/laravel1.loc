<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quality extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['quality'];
	public string $cachePrefix = 'quality_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [
		'title',
		'url',
	];

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
