<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class OtherLink extends Model
{
	public array  $cacheTags   = ['otherlink'];
	public string $cachePrefix = 'otherlink_';

	protected $fillable = [
		'anime_id',
		'title',
		'id_link',
		'url',
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
}
