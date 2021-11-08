<?php

namespace App\Models;

class Franchise extends Model
{
	public array  $cacheTags   = ['franchise'];
	public string $cachePrefix = 'franchise_';

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
