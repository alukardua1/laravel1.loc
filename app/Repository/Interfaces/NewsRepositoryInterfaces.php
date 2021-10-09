<?php


namespace App\Repository\Interfaces;


interface NewsRepositoryInterfaces
{
	/**
	 * @param  int|null  $id
	 * @param  int|null  $limit
	 *
	 * @return mixed
	 */
	public function getNews(int $id = null, int $limit = null);

	/**
	 * @param  \Request  $request
	 * @param  int|null  $id
	 *
	 * @return mixed
	 */
	public function setNews(\Request $request, int $id = null);

	/**
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function delNews(int $id);
}