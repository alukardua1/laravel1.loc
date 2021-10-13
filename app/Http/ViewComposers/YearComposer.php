<?php


namespace App\Http\ViewComposers;

use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\View\View;

class YearComposer
{
	private mixed                         $year;
	private YearAiredRepositoryInterfaces $yearRepository;

	/**
	 * @param  \App\Repository\Interfaces\YearAiredRepositoryInterfaces  $yearAiredRepositoryInterfaces
	 */
	public function __construct(YearAiredRepositoryInterfaces $yearAiredRepositoryInterfaces)
	{
		$this->yearRepository = $yearAiredRepositoryInterfaces;
		$this->year = $this->year();
	}

	/**
	 * @return mixed
	 */
	public function year(): mixed
	{
		return $this->yearRepository->getYearAired()->get();
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
		$view->with('year', $this->year);
	}
}