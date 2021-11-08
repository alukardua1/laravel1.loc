<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kind extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['kind'];
	public string $cachePrefix = 'kind_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [
		'name',
		'full_name',
		'short_name',
		'url',
	];

	/**
	 * Kind constructor.
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
