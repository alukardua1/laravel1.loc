<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\StudioRepositoryInterfaces;
use Illuminate\View\View;

class StudioComposer
{
	protected mixed                      $studio;
	protected StudioRepositoryInterfaces $studioRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  StudioRepositoryInterfaces  $studioRepositoryInterfaces
	 */
	public function __construct(StudioRepositoryInterfaces $studioRepositoryInterfaces)
	{
		$this->studioRepository = $studioRepositoryInterfaces;
		$this->studio = $this->studio();
	}

	/**
	 * @return mixed
	 */
	public function studio(): mixed
	{
		return $this->studioRepository->getStudio()->get();
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