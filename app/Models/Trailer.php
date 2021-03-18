<?php

namespace App\Models;

class Trailer extends Model
{
	public array  $cacheTags   = ['trailer'];
	public string $cachePrefix = 'trailer_';

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
