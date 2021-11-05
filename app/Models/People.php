<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getAnime(): HasMany
	{
		return $this->hasMany(Anime::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getJobs(): BelongsToMany
	{
		return $this->belongsToMany(JobPeople::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getCharacter(): BelongsToMany
	{
		return $this->belongsToMany(Character::class)->latest();
	}
}
