<?php

namespace App\Models;

class News extends Model
{
	public array  $cacheTags   = ['news'];
	public string $cachePrefix = 'news_';

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
