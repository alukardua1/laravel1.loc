<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CopyrightHolder
 *
 * @package App\Models
 */
class CopyrightHolder extends Model
{
    use HasFactory;

	public array  $cacheTags   = ['copyright_holder'];
	public string $cachePrefix = 'copyright_holder_';

	protected $fillable = [];

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
