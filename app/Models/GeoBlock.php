<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoBlock extends Model
{
	use HasFactory;

	public array  $cacheTags   = ['geo_block'];
	public string $cachePrefix = 'geo_block_';

	protected $fillable = [
		'code',
		'country',
	];

	/**
	 * GeoBlock constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
