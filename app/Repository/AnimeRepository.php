<?php


namespace App\Repository;

use App\Models\Anime;
use App\Models\Comment;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Services\FunctionTrait;

/**
 * Class AnimeRepository
 *
 * @package App\Repository
 */
class AnimeRepository implements AnimeRepositoryInterfaces
{
	use FunctionTrait;

	public function __construct()
	{
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getAnime($id)
	{
		return Anime::where('id', $id);
	}

	/**
	 * @param  bool  $isAdmin
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getAllAnime($isAdmin = false)
	{
		if ($isAdmin) {
			return Anime::orderBy('updated_at', 'DESC');
		}

		return Anime::where('posted_at', 1)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getFirstPageAnime($count)
	{
		return Anime::where('ongoing', 1)
			->limit($count)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param $columns
	 * @param $custom
	 *
	 * @return mixed
	 */
	public function getCustomAnime($columns, $custom)
	{
		return Anime::where($columns, $custom)
			->orderBy('updated_at', 'DESC');
	}

	public function getAnons($count)
	{
		return Anime::where('anons', 1)
			->limit($count)
			->orderBy('read_count', 'DESC');
	}

	public function getPopular($count)
	{
		return Anime::limit($count);
	}

	public function getSearchAnime($request, $limit = 5)
	{
		return Anime::where('name', 'LIKE', "%{$request->search}%")
			->orWhere('english', 'LIKE', "%{$request->search}%")
			->orWhere('japanese', 'LIKE', "%{$request->search}%")
			->orWhere('synonyms', 'LIKE', "%{$request->search}%")
			->orWhere('license_name_ru', 'LIKE', "%{$request->search}%")
			->orWhere('description', 'LIKE', "%{$request->search}%")
			->limit($limit)
			->get();
	}

	public function setComment($id, $request)
	{
		$validated = $request->validated();
		return Comment::create($request->all());
	}

	public function delComments($id, $fullDel)
	{
		$deleteComment = Comment::withTrashed()->where('id', $id)->first();
		$deleteParentComment = Comment::withTrashed()->where('parent_comment_id', $id)->get();

		if (!empty($fullDel)) {
			if ($deleteParentComment) {
				foreach ($deleteParentComment as $value) {
					if ($value->parent_comment_id = $id) {
						$deleteComment = $this->delComments($value->id, true);
					}
				}
			}
		}

		if ($deleteComment and empty($fullDel)) {
			return $deleteComment->delete();
		}else {
			return $deleteComment->forceDelete();
		}
	}
}