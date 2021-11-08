<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['news'];
	public string $cachePrefix = 'news_';

	protected $fillable = [];

	/**
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
