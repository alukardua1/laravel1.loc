<?php


namespace App\Repository;


use App\Models\News;
use App\Repository\Interfaces\NewsRepositoryInterfaces;

class NewsRepository implements NewsRepositoryInterfaces
{
	/**
	 * @param  int|null  $id
	 * @param  int|null  $limit
	 *
	 * @return mixed
	 */
	public function getNews(int $id = null, int $limit = null)
	{
		if ($id) {
			return News::where($id);
		} elseif ($limit) {
			return News::limit($limit)
				->orderBy('updated_at', 'DESC');
		}
		return News::orderBy('updated_at', 'DESC');
	}

	/**
	 * @param  \Request  $request
	 * @param  int|null  $id
	 *
	 * @return mixed|void
	 */
	public function setNews(\Request $request, int $id = null)
	{
		// TODO: Implement setNews() method.
	}

	/**
	 * @param  int  $id
	 *
	 * @return mixed|void
	 */
	public function delNews(int $id)
	{
		// TODO: Implement delNews() method.
	}
}