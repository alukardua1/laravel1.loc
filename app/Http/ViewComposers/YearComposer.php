<?php


namespace App\Http\ViewComposers;

use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\View\View;

class YearComposer
{
	public    $menu;
	protected $year;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\YearAiredRepositoryInterfaces  $yearAiredRepositoryInterfaces
	 */
	public function __construct(YearAiredRepositoryInterfaces $yearAiredRepositoryInterfaces)
	{
		$this->year = $yearAiredRepositoryInterfaces;
		$this->menu = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->year->getYearAired()->sortBy('name');
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