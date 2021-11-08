<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticPage extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['staticPage'];
	public string $cachePrefix = 'staticPage_';

	protected $fillable = [
		'title',
		'url',
		'description',
	];

	/**
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
