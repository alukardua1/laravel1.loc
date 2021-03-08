<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Kind
 *
 * @package App\Models
 */
class Kind extends Model
{
	protected $withCount = [
		'getAnime',
	];

	public $cacheTags = ['kind'];
	public $cachePrefix = 'kind_';
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
