<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GeoBlock extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['geo_block'];
	public string $cachePrefix = 'geo_block_';

	protected $fillable = [
		'code',
		'country',
	];

	/**
	 * GeoBlock constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
