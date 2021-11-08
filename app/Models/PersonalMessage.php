<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalMessage extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['pm'];
	public string $cachePrefix = 'pm_';

	protected $fillable = [];

	/**
	 * PersonalMessage constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
