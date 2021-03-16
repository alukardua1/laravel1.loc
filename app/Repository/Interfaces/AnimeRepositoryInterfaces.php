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

	/**
	 * @param       $request
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getSearchAnime($request, $limit = 5);

	/**
	 * @param $id
	 * @param $request
	 *
	 * @return mixed
	 */
	public function setComment($id, $request);

	/**
	 * @param $id
	 * @param $fullDel
	 *
	 * @return mixed
	 */
	public function delComments($id, $fullDel);

	/**
	 * @param $request
	 * @param $id
	 *
	 * @return mixed
	 */
	public function setAnime($request, $id);
}