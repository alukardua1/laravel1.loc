<?php


namespace App\Repository;

use App\Models\Anime;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;

class AnimeRepository implements AnimeRepositoryInterfaces
{

	public function getAnime($id)
	{
		return Anime::where('id', $id)
			->with(['getCategory:id,title,description,url', 'getUser:id,login,group_id', 'getKind']);
	}

	public function getAllAnime($isAdmin = null)
	{
		if ($isAdmin) {
			return Anime::with(['getCategory:id,title', 'getUser:id,login'])
				->orderBy('updated_at', 'DESC');
		}

		return Anime::where('posted_at', 1)
			->with(['getCategory:id,title,description,url', 'getUser:id,login,group_id', 'getKind'])
			->orderBy('updated_at', 'DESC');
	}

	public function getFirstPageAnime($count)
	{
		return Anime::where('status', 'ongoing')
			->with(['getCategory:id,title', 'getUser:id,login'])
			->limit($count)
			->orderBy('updated_at', 'DESC');
	}
}