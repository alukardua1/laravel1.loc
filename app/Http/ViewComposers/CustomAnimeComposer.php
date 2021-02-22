<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;

class CustomAnimeComposer
{
	protected $anime;
	protected $animeAll;

	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeAll = $animeRepositoryInterfaces;
	}

	public function anime($columns, $custom, $limit)
	{
		return $this->animeAll->getCustomAnime($columns, $custom)->limit($limit)->get();
	}

	public function compose()
	{

	}
}