<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TableOrder extends Model
{
    use HasFactory;

	public array  $cacheTags   = ['anime'];
	public string $cachePrefix = 'anime_';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getTranslate(): BelongsToMany
	{
		return $this->belongsToMany(Translate::class)->latest();
	}
}
