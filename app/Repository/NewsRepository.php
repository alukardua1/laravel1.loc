<?php


namespace App\Repository;


use App\Models\News;
use App\Repository\Interfaces\NewsRepositoryInterfaces;

class NewsRepository implements NewsRepositoryInterfaces
{

	public function getNewsAll($limit = null)
	{
		if ($limit) {
		    return News::limit($limit)
			    ->orderBy('updated_at', 'DESC');
		}
		return  News::orderBy('updated_at', 'DESC');
	}

	public function getNews(int $id)
	{
		return News::where($id);
	}

	public function setNews(\Request $request, int $id = null)
	{
		// TODO: Implement setNews() method.
	}

	public function delNews(int $id)
	{
		// TODO: Implement delNews() method.
	}
}