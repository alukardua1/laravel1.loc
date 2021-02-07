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
	protected $withArr = [
		'getCategory:id,title,description,url',
		'getUser:id,login,group_id',
		'getKind',
		'getOtherLink',
		'getStudio',
	];

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getAnime($id)
	{
		return Anime::where('id', $id)
			->with($this->withArr);
	}

	/**
	 * @param  null  $isAdmin
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getAllAnime($isAdmin = null)
	{
		if ($isAdmin) {
			return Anime::with($this->withArr)
				->orderBy('updated_at', 'DESC');
		}

		return Anime::where('posted_at', 1)
			->with($this->withArr)
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
			->with($this->withArr)
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
			->with($this->withArr)
			->orderBy('updated_at', 'DESC');
	}
}