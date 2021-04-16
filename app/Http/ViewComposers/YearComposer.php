<?php


namespace App\Http\ViewComposers;

use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\View\View;

class YearComposer
{
	protected mixed                         $year;
	protected YearAiredRepositoryInterfaces $yearRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  YearAiredRepositoryInterfaces  $yearAiredRepositoryInterfaces
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
		return $this->yearRepository->getYearAired()->sortBy('name');
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