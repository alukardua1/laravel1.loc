<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;

class CustomAnimeComposer
{
	private mixed                     $custom;
	private AnimeRepositoryInterfaces $animeRepository;

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
	}

	/**
	 * @param  string  $columns
	 * @param  string  $custom
	 * @param  int     $limit
	 *
	 * @return mixed
	 */
	public function anime(string $columns, string $custom, int $limit): mixed
	{
		return $this->animeRepository->getCustomAnime($columns, $custom)->limit($limit)->get();
	}

	/**
	 *
	 */
	public function compose()
	{
	}
}