<?php

namespace App\Models;


/**
 * Class Kind
 *
 * @package App\Models
 */
class Kind extends Model
{
    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }

	protected $withCount = [
		'getAnime',
	];

    public function getAnime()
    {
    	return $this->hasMany(Anime::class);
    }
}
