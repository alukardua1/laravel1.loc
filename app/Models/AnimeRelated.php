<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AnimeRelated
 *
 * @package App\Models
 */
class AnimeRelated extends Model
{
	public array  $cacheTags   = ['anime_related'];
	public string $cachePrefix = 'anime_related_';

	protected $fillable = [];

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
