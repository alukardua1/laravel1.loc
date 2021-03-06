<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed title
 * @property mixed id
 */
class Anime extends Model
{
	protected $fillable = [
		'name',
		'russian',
		'original_img',
		'preview_img',
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
		'anons',
		'ongoing',
		'posted_at',
		'comment_at',
		'broadcast',
	];

	protected $withCount = [
		'getVote',
	];

	protected $appends = [
		'category',
		'getKind',
		'getUser',
		'getChannel',
		'getStudio',
		'getQuality',
		'getRating',
		'getCountry',
		'getTranslate',
		'getVote',
		'vote',
		'getTrailer',
		'getPlayer',
		'getRegionBlock',
		'getYear',
	];

	/**
	 * Anime constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function getAiredOnAttribute($value)
	{
		return $this->attributes['aired_on'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function getReleasedOnAttribute($value)
	{
		return $this->attributes['released_on'] = (new Carbon($value))->format('d.m.Y');
	}

	/**
	 * @return array
	 */
	public function getVoteAttribute()
	{
		return $this->votePlusMinus($this->getVote()->get());
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

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getUser()
	{
		return $this->hasOne(User::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getKind(): BelongsTo
	{
		return $this->belongsTo(Kind::class, 'kind_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getOtherLink(): HasMany
	{
		return $this->hasMany(OtherLink::class, 'anime_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getStudio(): BelongsToMany
	{
		return $this->belongsToMany(Studio::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getChannel()
	{
		return $this->belongsTo(Channel::class, 'channel_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getQuality()
	{
		return $this->belongsToMany(Quality::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getRating()
	{
		return $this->belongsTo(MPAARating::class, 'rating_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getCountry()
	{
		return $this->belongsToMany(Country::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getTranslate()
	{
		return $this->belongsToMany(Translate::class);
	}

	/**
	 * @return bool
	 */
	public function favorited(): bool
	{
		return (bool)$this->hasMany(Favorites::class)
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}

	/**
	 * @return bool
	 */
	public function votes()
	{
		return (bool)$this->hasMany(Vote::class)
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getVote()
	{
		return $this->hasMany(Vote::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getTrailer()
	{
		return $this->hasMany(Trailer::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getPlayer()
	{
		return $this->hasMany(Player::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getRegionBlock()
	{
		return $this->hasMany(RegionBlock::class);
	}

	public function getYear()
	{
		return $this->hasOne(YearAired::class);
	}
}
