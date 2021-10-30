<?php

namespace App\Models;

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

	public function getAnime()
	{
		return $this->hasMany(Anime::class)->latest();
	}
}
