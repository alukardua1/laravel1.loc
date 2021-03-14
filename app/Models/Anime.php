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
 * @property mixed title
 * @property mixed id
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
	];

	public $cacheTags = ['anime'];
	public $cachePrefix = 'anime_';

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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getUser()
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
	public function getChannel()
	{
		return $this->belongsTo(Channel::class, 'channel_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getQuality()
	{
		return $this->belongsToMany(Quality::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function getRating()
	{
		return $this->belongsTo(MPAARating::class, 'rating_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getCountry()
	{
		return $this->belongsToMany(Country::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getTranslate()
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
	public function votes()
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
	public function getVote()
	{
		return $this->hasMany(Vote::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getTrailer()
	{
		return $this->hasMany(Trailer::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getPlayer()
	{
		return $this->hasMany(Player::class)->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getRegionBlock()
	{
		return $this->hasMany(RegionBlock::class)->latest();
	}

	public function getYear()
	{
		return $this->hasOne(YearAired::class)->latest();
	}

	public function getComments()
	{
		return $this->belongsTo(Comment::class, 'id', 'anime_id')->latest();
	}

	public function getRelationAnime()
	{
		return $this->belongsToMany($this, 'anime_related', 'anime_id', 'relation_id', 'id', 'id')->latest();
	}
}
