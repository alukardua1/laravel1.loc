<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'description',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getAnime(): BelongsTo
    {
        return $this->belongsTo(Anime::class, 'anime_id', 'id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPost(): BelongsTo
    {
        return $this->belongsTo(News::class, 'post_id', 'id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getAuthorComment(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getParrentComment(): HasOne
    {
        return $this->hasOne($this, 'id', 'parent_comment_id')->latest();
    }
}
