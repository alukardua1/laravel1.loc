<?php


namespace App\Repository\Interfaces;


use Request;

interface NewsRepositoryInterfaces
{
	/**
	 * @param  int|null  $id
	 * @param  int|null  $limit
	 *
	 * @return mixed
	 */
	public function getNews(int $id = null, int $limit = null): mixed;

	/**
	 * @param  \Request  $request
	 * @param  int|null  $id
	 *
	 * @return mixed
	 */
	public function setNews(Request $request, int $id = null): mixed;

	/**
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function delNews(int $id): mixed;
}