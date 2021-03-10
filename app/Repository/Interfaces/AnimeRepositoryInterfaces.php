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
	 * @return mixed
	 */
	public function getAllAnime();

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

	public function getSearchAnime($request);

	public function setComment($id, $request);
}