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
	 * @param $year
	 *
	 * @return mixed
	 */
	public function getYear($year);
}