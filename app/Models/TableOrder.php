<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class TableOrder extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['anime'];
	public string $cachePrefix = 'anime_';

	protected $fillable = [
		'user_id',
		'status',
		'name_rus',
		'name_origin',
		'year',
		'wa_url',
		'kp_url',
		'imdb_url',
		'shikimori_url',
		'translate_id',
		'download_url',
	];

	protected $appends = [
		'getTranslate',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getTranslate()
	{
		return $this->hasOne(Translate::class, 'id', 'translate_id')->latest();
	}
}
