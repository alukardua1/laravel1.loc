<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CopyrightHolder extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['copyright_holder'];
	public string $cachePrefix = 'copyright_holder_';

	protected $fillable = [
		'title',
	];

	/**
	 * CopyrightHolder constructor.
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
