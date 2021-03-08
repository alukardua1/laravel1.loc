<?php

namespace App\Models;

class Trailer extends Model
{
	public $cacheTags = ['trailer'];
	public $cachePrefix = 'trailer_';

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
