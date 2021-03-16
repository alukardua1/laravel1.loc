<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\StudioRepositoryInterfaces;
use Illuminate\View\View;

class StudioComposer
{
	public    $studio;
	protected $studioRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\StudioRepositoryInterfaces  $studioRepositoryInterfaces
	 */
	public function __construct(StudioRepositoryInterfaces $studioRepositoryInterfaces)
	{
		$this->studioRepository = $studioRepositoryInterfaces;
		$this->studio = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->studioRepository->getStudio();
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
		$view->with('studios', $this->studio);
	}
}