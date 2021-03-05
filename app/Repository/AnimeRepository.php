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

	public function getYear($year)
	{
		return Anime::latest()
			->whereBetween('aired_on', [$year . '-01-01', $year . '-12-31'])
			->orderBy('updated_at', 'DESC');
	}
}