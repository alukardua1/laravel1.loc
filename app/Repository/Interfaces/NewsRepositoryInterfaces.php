<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

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
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int|null                  $id
	 *
	 * @return mixed
	 */
	public function setNews(Request $request, int $id = null): mixed;

	/**
	 * @param  int   $id
	 * @param  bool  $fullDel
	 *
	 * @return mixed
	 */
	public function delNews(int $id, bool $fullDel = false): mixed;
}