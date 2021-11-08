<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['studio'];
	public string $cachePrefix = 'studio_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [
		'title',
		'url',
	];

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
