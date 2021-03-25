<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CopyrightHolder
 *
 * @package App\Models
 */
class CopyrightHolder extends Model
{
    use HasFactory;

	public array  $cacheTags   = ['copyright_holder'];
	public string $cachePrefix = 'copyright_holder_';

	protected $fillable = [];

	/**
	 * CopyrightHolder constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}
}
