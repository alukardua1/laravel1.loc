<?php


namespace App\Repository\Interfaces;


/**
 * Interface AnimeRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface AnimeRepositoryInterfaces
{
	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getAnime($id);

	/**
	 * @param  bool  $isAdmin
	 *
	 * @return mixed
	 */
	public function getAllAnime($isAdmin = false);

	/**
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getFirstPageAnime($count);

	/**
	 * @param $columns
	 * @param $custom
	 *
	 * @return mixed
	 */
	public function getCustomAnime($columns, $custom);

	/**
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getAnons($count);

	/**
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getPopular($count);

	public function getSearchAnime($request, $limit = 5);

	public function setComment($id, $request);

	public function delComments($id, $fullDel);
}