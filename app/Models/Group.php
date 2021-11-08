<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['group'];
	public string $cachePrefix = 'group_';

	protected $fillable = [
		'title',
		'description',
		'color',
		'is_dashboard',
	];

	protected $withCount = [
		'getUser',
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
