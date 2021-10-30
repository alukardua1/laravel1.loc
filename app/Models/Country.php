<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
	public array  $cacheTags   = ['country'];
	public string $cachePrefix = 'country_';

	protected $fillable = [
		'title',
		'url',
	];

	protected $withCount = [
		'getAnime',
	];

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
