<?php

namespace App\Models;

/**
 * Class OtherLink
 *
 * @package App\Models
 */
class OtherLink extends Model
{
	public array  $cacheTags   = ['otherlink'];
	public string $cachePrefix = 'otherlink_';

	protected $fillable = [
		'anime_id',
		'title',
		'url'
	];
	/**
	 * OtherLink constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
