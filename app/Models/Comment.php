<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getAnime(): BelongsToMany
	{
		return $this->belongsToMany(Anime::class, 'post_comment', 'id', 'anime_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getPost(): BelongsToMany
	{
		return $this->belongsToMany(News::class, 'post_comment', 'id', 'post_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getUser(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'user_comment', 'id', 'repient_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function getAuthorComment(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'user_comment', 'id', 'author_id')->latest();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getParrentComment(): HasOne
	{
		return $this->hasOne($this, 'id', 'parent_comment_id')->latest();
	}
}
