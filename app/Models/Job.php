<?php

namespace App\Models;


/**
 * Class Job
 *
 * @package App\Models
 */
class Job extends Model
{
	public array  $cacheTags   = ['job'];
	public string $cachePrefix = 'job_';
	/**
	 * Job constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
