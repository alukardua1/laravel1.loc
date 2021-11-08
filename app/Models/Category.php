<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['category'];
	public string $cachePrefix = 'category_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [
		'title',
		'english',
		'url',
		'description',
		'posted_at',
	];

	/**
	 * Category constructor.
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
	public function getAnime(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class)->latest();
	}
}
