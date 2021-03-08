<?php

namespace App\Models;


/**
 * Class Translate
 *
 * @package App\Models
 */
class Translate extends Model
{
	protected $withCount = [
		'getAnime',
	];

	public $cacheTags = ['translate'];
	public $cachePrefix = 'translate_';
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getAnime()
	{
		return $this->belongsToMany(Anime::class)->latest();
	}
}
