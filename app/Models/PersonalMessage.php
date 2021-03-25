<?php

namespace App\Models;


/**
 * Class PersonalMessage
 *
 * @property int    author_id
 * @property int    recipient_id
 * @property string title
 * @property mixed  description
 *
 * @package App\Models
 */
class PersonalMessage extends Model
{
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
