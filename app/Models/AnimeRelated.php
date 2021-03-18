<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimeRelated extends Model
{
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getAnimeRelation(): BelongsTo
	{
		return $this->belongsTo(Anime::class, 'id', 'relation_id')->latest();
	}
}
