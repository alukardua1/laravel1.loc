<?php

namespace App\Models;

/**
 * Class Trailer
 *
 * @package App\Models
 */
class Trailer extends Model
{
	public array  $cacheTags   = ['trailer'];
	public string $cachePrefix = 'trailer_';

	protected $fillable = [];

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
