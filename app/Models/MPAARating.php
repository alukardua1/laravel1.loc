<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MPAARating extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['mpaa'];
	public string $cachePrefix = 'mpaa_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [
		'name',
		'url',
		'description',
	];

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
