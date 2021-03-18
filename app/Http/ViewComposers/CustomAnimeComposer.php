<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;

class CustomAnimeComposer
{
	protected                           $custom;
	protected AnimeRepositoryInterfaces $animeRepository;

	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
	}

	public function anime($columns, $custom, $limit)
	{
		return $this->animeRepository->getCustomAnime($columns, $custom)->limit($limit)->get();
	}

	public function compose()
	{

	}
}