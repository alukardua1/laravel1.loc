<?php

namespace App\Models;


/**
 * Class Kind
 *
 * @package App\Models
 */
class Kind extends Model
{
	protected $withCount = [
		'getAnime',
	];
	/**
	 * Kind constructor.
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
	public function getAnime()
    {
    	return $this->hasMany(Anime::class);
    }
}
