<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorites extends Model
{
	public array  $cacheTags   = ['favorites'];
	public string $cachePrefix = 'favorites_';

	/**
	 * Favorites constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getUser(): BelongsTo
    {
    	return $this->belongsTo(User::class)->latest();
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getAnime(): BelongsTo
	{
		return $this->belongsTo(Anime::class)->latest();
	}
}
