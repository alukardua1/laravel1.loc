<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 */
class StaticPage extends Model
{
	public array  $cacheTags   = ['static_page'];
	public string $cachePrefix = 'static_page_';

	protected $fillable = [];

	/**
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getUser(): HasOne
	{
		return $this->hasOne(User::class, 'id', 'user_id')->latest();
	}
}
