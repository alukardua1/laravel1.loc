<?php

namespace App\Models;

/**
 * Class YearAired
 *
 * @package App\Models
 */
class YearAired extends Model
{
	protected $withCount = [
		'getAnime',
	];

	/**
	 * YearAired constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getAnime()
    {
    	return $this->belongsTo(Anime::class, 'id', 'aired_season');
    }
}
