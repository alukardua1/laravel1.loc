<?php

namespace App\Models;

/**
 * Class RegionBlock
 *
 * @package App\Models
 */
class RegionBlock extends Model
{
	public array  $cacheTags   = ['regionblock'];
	public string $cachePrefix = 'regionblock_';

	protected $fillable = [];

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
