<?php

namespace App\Models;

/**
 * Class Vote
 *
 * @package App\Models
 */
class Vote extends Model
{
	public array  $cacheTags   = ['vote'];
	public string $cachePrefix = 'vote_';

	/**
	 * Vote constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
