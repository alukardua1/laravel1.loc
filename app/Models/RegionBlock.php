<?php

namespace App\Models;

class RegionBlock extends Model
{
	public array  $cacheTags   = ['regionblock'];
	public string $cachePrefix = 'regionblock_';

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
