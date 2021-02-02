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

    public function getCategory()
    {
	    return $this->belongsToMany(Category::class);
    }

    public function getUser()
    {
    	return $this->belongsTo(User::class, 'user_id')->with(['getGroup']);
    }

    public function getKind()
    {
    	return $this->belongsTo(Kind::class, 'kind');
    }
}
