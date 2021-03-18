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
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->anons = $this->anons();
	}

	/**
	 * @return mixed
	 */
	public function anons()
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