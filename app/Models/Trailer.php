<?php

namespace App\Models;

class Trailer extends Model
{
	public array  $cacheTags   = ['trailer'];
	public string $cachePrefix = 'trailer_';

	protected $fillable = [
		'anime_id',
		'url_trailer',
	];

	/**
	 * Trailer constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
