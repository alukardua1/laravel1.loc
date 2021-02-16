<?php

namespace App\Models;

use App\Services\MutationTrait;
use Auth;
use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * @method static where(string $string, $id)
 */
class Anime extends Model
{
	use HasFactory, MutationTrait, QueryCacheable;
	protected $cacheFor;

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->cacheFor = Config::get('secondConfig.cache_time');
	}

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
		return $this->categoryMutation($this->getCategory()->get());
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

	public function favorited(): bool
	{
		return (bool)$this->hasMany(Favorites::class)
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}
}
