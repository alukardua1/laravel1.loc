<?php

namespace App\Models;

/**
 * Class Vote
 *
 * @package App\Models
 */
class Vote extends Model
{
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
