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

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getAnime($id)
	{
		return Anime::where('id', $id)
			->with(['getCategory:id,title,description,url', 'getUser:id,login,group_id', 'getKind', 'getOtherLink']);
	}

	/**
	 * @param  null  $isAdmin
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getAllAnime($isAdmin = null)
	{
		if ($isAdmin) {
			return Anime::with(['getCategory:id,title', 'getUser:id,login', 'getOtherLink'])
				->orderBy('updated_at', 'DESC');
		}

		return Anime::where('posted_at', 1)
			->with(['getCategory:id,title,description,url', 'getUser:id,login,group_id', 'getKind', 'getOtherLink'])
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getFirstPageAnime($count)
	{
		return Anime::where('status', 'ongoing')
			->with(['getCategory:id,title', 'getUser:id,login'])
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
			->with(['getCategory:id,title,description,url', 'getUser:id,login,group_id', 'getKind'])
			->orderBy('updated_at', 'DESC');
	}
}