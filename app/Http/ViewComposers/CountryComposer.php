<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\View\View;

class CountryComposer
{
	public    $menu;
	protected $country;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\CountryRepositoryInterfaces  $countryRepositoryInterfaces
	 */
	public function __construct(CountryRepositoryInterfaces $countryRepositoryInterfaces)
	{
		$this->country = $countryRepositoryInterfaces;
		$this->menu = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->country->getCountry();
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