<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class JobPeople extends Model
{
	use SoftDeletes;

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

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getPeople()
	{
		return $this->belongsToMany(People::class)->latest();
	}
}
