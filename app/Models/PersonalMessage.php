<?php

namespace App\Models;

class PersonalMessage extends Model
{
	public array  $cacheTags   = ['pm'];
	public string $cachePrefix = 'pm_';

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
