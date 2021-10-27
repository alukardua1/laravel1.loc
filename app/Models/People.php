<?php

namespace App\Models;

class People extends Model
{
	public array  $cacheTags   = ['people'];
	public string $cachePrefix = 'people_';

	protected $fillable = [
		'name',
		'english',
		'japanese',
		'img',
		'url',
		'birthday',
		'website',
	];

	/**
	 * OtherLink constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	public function getAnime()
	{
		return $this->hasMany(Anime::class)->latest();
	}

	public function getJobs()
	{
		return $this->belongsToMany(JobPeople::class)->latest();
	}
}
