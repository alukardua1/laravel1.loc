<?php

namespace App\Models;


/**
 * Class Job
 *
 * @package App\Models
 */
class JobPeople extends Model
{
	public array  $cacheTags   = ['job'];
	public string $cachePrefix = 'job_';

	protected $fillable = [
		'title',
	];

	/**
	 * Job constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	public function getPeople()
	{
		return $this->belongsToMany(People::class)->latest();
	}
}
