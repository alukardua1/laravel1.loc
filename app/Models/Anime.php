<?php

namespace App\Models;

use App\Services\AnimeModelTrait;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Anime
 *
 * @package App\Models
 */
class Anime extends Model
{
	use AnimeModelTrait;

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
		'getCopyrightHolder',
	];

	public array  $cacheTags   = ['anime'];
	public string $cachePrefix = 'anime_';

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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getCategory(): BelongsToMany
	{
		return $this->belongsToMany(Category::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getUser(): HasOne
	{
		return $this->hasOne(User::class, 'id', 'user_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getKind(): BelongsTo
	{
		return $this->belongsTo(Kind::class, 'kind_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getOtherLink(): HasMany
	{
		return $this->hasMany(OtherLink::class, 'anime_id', 'id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getStudio(): BelongsToMany
	{
		return $this->belongsToMany(Studio::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getChannel(): BelongsTo
	{
		return $this->belongsTo(Channel::class, 'channel_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getQuality(): BelongsToMany
	{
		return $this->belongsToMany(Quality::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getRating(): BelongsTo
	{
		return $this->belongsTo(MPAARating::class, 'rating_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getCountry(): BelongsToMany
	{
		return $this->belongsToMany(Country::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getTranslate(): BelongsToMany
	{
		return $this->belongsToMany(Translate::class)->latest();
	}

	/**
	 * @return bool
	 */
	public function favorited(): bool
	{
		return (bool)$this->hasMany(Favorites::class)
			->latest()
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}

	/**
	 * @return bool
	 */
	public function votes(): bool
	{
		return (bool)$this->hasMany(Vote::class)
			->latest()
			->where('user_id', Auth::id())
			->where('anime_id', $this->id)
			->first();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getVote(): HasMany
	{
		return $this->hasMany(Vote::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getTrailer(): HasMany
	{
		return $this->hasMany(Trailer::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getPlayer(): HasMany
	{
		return $this->hasMany(Player::class)->latest();
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getRegionBlock(): BelongsToMany
	{
		return $this->belongsToMany(GeoBlock::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getYear(): HasOne
	{
		return $this->hasOne(YearAired::class, 'id', 'aired_season')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getComments(): BelongsTo
	{
		return $this->belongsTo(Comment::class, 'id', 'anime_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getRelationAnime(): BelongsToMany
	{
		return $this->belongsToMany($this, 'anime_related', 'anime_id', 'relation_id', 'id', 'id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getCopyrightHolder(): BelongsToMany
	{
		return $this->belongsToMany(CopyrightHolder::class)->latest();
	}
}
