<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Translate
 *
 * @package App\Models
 */
class Translate extends Model
{
	public array  $cacheTags   = ['translate'];
	public string $cachePrefix = 'translate_';

	protected $withCount = [
		'getAnime',
	];

	protected $fillable = [
		'title',
		'url',
	];

	/**
	 * MPAARating constructor.
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

	public function getTableOrder()
	{
		return $this->belongsToMany(TableOrder::class)->latest();
	}
}
