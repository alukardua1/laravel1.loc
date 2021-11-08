<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
	use SoftDeletes;

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
