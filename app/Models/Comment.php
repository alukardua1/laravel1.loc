<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 *
 * @package App\Models
 */
class Comment extends Model
{
	use SoftDeletes;

	public array  $cacheTags   = ['comments'];
	public string $cachePrefix = 'comments_';

	protected $fillable = [
	'anime_id',
	'parent_comment_id',
	'user_id',
	'author_id',
	'description_html'
	];

	/**
	 * Comment constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }

	/**
	 * @return string
	 */
	public function getCreatedAttribute(): string
	{
		return $this->attributes['created'] = (new Carbon($this->created_at))->format('d.m.Y');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getAnime(): HasOne
	{
		return $this->hasOne(Anime::class, 'id', 'anime_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getUser(): HasOne
	{
		return $this->hasOne(User::class, 'id', 'user_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getAuthorComment(): HasOne
	{
		return $this->hasOne(User::class, 'id', 'author_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getParrentComment(): HasOne
	{
		return $this->hasOne($this, 'id', 'parent_comment_id')->latest();
	}
}
