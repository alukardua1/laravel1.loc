<?php

namespace App\Models;

class RegionBlock extends Model
{
	public $cacheTags = ['regionblock'];
	public $cachePrefix = 'regionblock_';

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
