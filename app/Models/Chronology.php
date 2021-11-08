<?php

namespace App\Models;

class Chronology extends Model
{
	public array  $cacheTags   = ['chronology'];
	public string $cachePrefix = 'chronology_';

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
