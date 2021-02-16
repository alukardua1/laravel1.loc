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
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	public function getUser(): HasMany
    {
    	return $this->hasMany(User::class);
    }
}
