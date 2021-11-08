<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RegionBlock extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['regionblock'];
	public string $cachePrefix = 'regionblock_';

	protected $fillable = [

	];

	/**
	 * RegionBlock constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
