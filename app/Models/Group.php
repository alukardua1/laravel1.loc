<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Group
 *
 * @package App\Models
 */
class Group extends Model
{
	public array  $cacheTags   = ['group'];
	public string $cachePrefix = 'group_';

	protected $fillable = [
		'title',
		'description',
		'color',
		'is_dashboard',
	];

	/**
	 * Group constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getUser(): HasMany
    {
    	return $this->hasMany(User::class)->latest();
    }
}
