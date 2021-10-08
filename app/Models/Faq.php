<?php

namespace App\Models;

class Faq extends Model
{
	public array  $cacheTags   = ['faq'];
	public string $cachePrefix = 'faq_';

	protected $fillable = [
		'title',
		'url',
		'description',
	];

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
