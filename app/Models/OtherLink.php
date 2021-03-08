<?php

namespace App\Models;

/**
 * Class OtherLink
 *
 * @package App\Models
 */
class OtherLink extends Model
{
	public $cacheTags = ['otherlink'];
	public $cachePrefix = 'otherlink_';
	/**
	 * OtherLink constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
