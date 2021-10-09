<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
	public array  $cacheTags   = ['staticPage'];
	public string $cachePrefix = 'staticPage_';

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
