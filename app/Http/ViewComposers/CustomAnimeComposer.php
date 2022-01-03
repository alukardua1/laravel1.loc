<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;

class CustomAnimeComposer
{
	private AnimeRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->repository = $animeRepositoryInterfaces;
	}

	/**
	 * @param  string  $columns
	 * @param  string  $custom
	 * @param  int     $limit
	 *
	 * @return mixed
	 */
	protected function view(string $columns, string $custom, int $limit): mixed
	{
		return $this->repository->getCustomAnime($columns, $custom)->limit($limit)->get();
	}

	/**
	 *
	 */
	public function compose()
	{
	}
}