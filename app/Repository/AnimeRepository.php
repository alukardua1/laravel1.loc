<?php


namespace App\Repository;

use App\Models\Anime;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;

/**
 * Class AnimeRepository
 *
 * @package App\Repository
 */
class AnimeRepository implements AnimeRepositoryInterfaces
{
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
		return Anime::latest()
			->where('id', $id);
	}

	/**
	 * @param  null  $isAdmin
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getAllAnime($isAdmin = null)
	{
		if ($isAdmin) {
			return Anime::latest()
				->orderBy('updated_at', 'DESC');
		}

		return Anime::latest()
			->where('posted_at', 1)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getFirstPageAnime($count)
	{
		return Anime::latest()
			->where('ongoing', 1)
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
		return Anime::latest()
			->where($columns, $custom)
			->orderBy('updated_at', 'DESC');
	}

	public function getAnons($count)
	{
		return Anime::latest()
			->where('anons', 1)
			->limit($count)
			->orderBy('read_count', 'DESC');
	}

	public function getPopular($count)
	{
		return Anime::latest()
			->limit($count);
	}

	public function getSearchAnime($request)
	{
		return Anime::where('name', 'LIKE', "%{$request->search}%")
			->orWhere('english', 'LIKE', "%{$request->search}%")
			->orWhere('japanese', 'LIKE', "%{$request->search}%")
			->orWhere('synonyms', 'LIKE', "%{$request->search}%")
			->orWhere('license_name_ru', 'LIKE', "%{$request->search}%")
			->orWhere('description', 'LIKE', "%{$request->search}%")
			->limit(5)
			->get();
	}
}