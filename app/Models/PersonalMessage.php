<?php

namespace App\Models;

class PersonalMessage extends Model
{
	public $cacheTags = ['pm'];
	public $cachePrefix = 'pm_';

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
