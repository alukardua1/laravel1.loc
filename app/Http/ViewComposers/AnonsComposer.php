<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

class AnonsComposer
{
	private mixed                     $anons;
	private AnimeRepositoryInterfaces $animeRepository;

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->anons = $this->anons();
	}

	/**
	 * @return mixed
	 */
	public function anons(): mixed
	{
		return $this->animeRepository->getAnons(100)->get();
	}

	/**
	 * @param  View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeAnons', $this->anons);
	}
}