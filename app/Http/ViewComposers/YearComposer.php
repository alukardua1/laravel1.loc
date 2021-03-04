<?php


namespace App\Http\ViewComposers;


use App\Models\Anime;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

class YearComposer
{
	public    $menu;
	protected $year;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->year = $animeRepositoryInterfaces;
		$this->menu = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		$yearDate = $this->year->getAllAnime()->get();
		foreach ($yearDate as $value)
		{
			$years[] = date('Y', strtotime($value->aired_on));
		}
		$get_anime_count = array_count_values($years);
		$name = array_unique($years);
		$url = array_unique($years);
		foreach ($name as $key=>$value)
		{
			$year[] = ['url'=>$url[$key], 'name'=>$name[$key], 'get_anime_count'=>$get_anime_count[$value]];
		}
		$year = collect($year)->sort();

		return $year;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 *
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('menu', $this->menu);
	}
}