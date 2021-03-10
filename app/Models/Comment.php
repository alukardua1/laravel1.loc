<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use SoftDeletes;

	public $cacheTags = ['comments'];
	public $cachePrefix = 'comments_';

	protected $fillable = [
	'anime_id',
	'parent_comment_id',
	'user_id',
	'author_id',
	'description_html'
	];

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }

	public function getCreatedAttribute($value)
	{
		return $this->attributes['created'] = (new Carbon($this->created_at))->format('d.m.Y');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getAnime()
	{
		return $this->hasOne(Anime::class, 'id', 'anime_id')->latest();
	}

	public function getUser()
	{
		return $this->hasOne(User::class, 'id', 'user_id')->latest();
	}

	public function getAuthorComment()
	{
		return $this->hasOne(User::class, 'id', 'author_id')->latest();
	}

	public function getParrentComment()
	{
		return $this->hasOne($this, 'id', 'parent_comment_id')->latest();
	}
}
