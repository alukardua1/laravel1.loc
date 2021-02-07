<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class Anime extends Model
{
	use HasFactory;

	/**
	 * @var string[]
	 */
	protected $fillable = [
		'name',
		'russian',
		'original_img',
		'preview_img',
		'status',
		'episodes',
		'episodes_aired',
		'aired_on',
		'released_on',
		'rating',
		'english',
		'japanese',
		'synonyms',
		'license_name_ru',
		'duration',
		'description',
		'description_html',
		'description_source',
		'franchise',
		'anons',
		'ongoing',
		'blocking',
		'region',
		'posted_at',
		'comment_at',
		'broadcast',
	];

	protected $appends = [
		'category',
	];

	/**
	 * @todo Временное решение придумать как изменить
	 */
	public function getCategoryAttribute()
	{
		$result = [];
		$category = $this->getCategory()->get();
		foreach ($category as $value) {
			$result[] = "<a href=\"/category/{$value->url}\">{$value->title}</a>";
		}
		$result = implode(' / ', $result);
		return $result;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getCategory()
	{
		return $this->belongsToMany(Category::class);
	}

	public function getUser()
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getKind()
	{
		return $this->belongsTo(Kind::class, 'kind');
	}

	public function getOtherLink()
	{
		return $this->hasMany(OtherLink::class, 'anime_id', 'id');
	}

	public function getStudio()
	{
		return $this->belongsToMany(Studio::class);
	}
}
