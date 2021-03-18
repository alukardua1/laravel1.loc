<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

class AnonsComposer
{
	protected                           $anons;
	protected AnimeRepositoryInterfaces $animeRepository;

	/**
	 * CarouselAnimeComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->anons = $this->anime();
	}

	/**
	 * @return mixed
	 */
	public function anime()
	{
		return $this->animeRepository->getAnons(100)->get();
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeAnons', $this->anons);
	}
}