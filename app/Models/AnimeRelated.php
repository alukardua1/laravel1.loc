<?php

namespace App\Models;

class AnimeRelated extends Model
{
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	public function getAnimeRelation()
	{
		return $this->belongsTo(Anime::class, 'id', 'relation_id')->latest();
	}
}
