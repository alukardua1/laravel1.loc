<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static where(string $string, $id)
 */
class Anime extends Model
{
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
	protected $appends  = [
		'category',
		'getKind',
		'getChannel',
		'getStudio',
		'getQuality',
		'getRating',
		'getCountry',
	];

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

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
	public function getCategory(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	public function getUser(): HasOne
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getKind(): BelongsTo
	{
		return $this->belongsTo(Kind::class, 'kind_id');
	}

	public function getOtherLink(): HasMany
	{
		return $this->hasMany(OtherLink::class, 'anime_id', 'id');
	}

	public function getStudio(): BelongsToMany
	{
		return $this->belongsToMany(Studio::class);
	}

	public function getChannel()
	{
		return $this->belongsTo(Channel::class, 'channel_id');
	}

	public function getQuality()
	{
		return $this->belongsToMany(Quality::class);
	}

	public function getRating()
	{
		return $this->belongsTo(MPAARating::class, 'rating_id');
	}

	public function getCountry()
	{
		return $this->belongsToMany(Country::class);
	}

	public function favorited(): bool
	{
		return (bool)$this->hasMany(Favorites::class)
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}
}
