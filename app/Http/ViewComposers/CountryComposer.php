<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\View\View;

class CountryComposer
{
	private mixed                       $country;
	private CountryRepositoryInterfaces $countryRepository;

	/**
	 * @param  \App\Repository\Interfaces\CountryRepositoryInterfaces  $countryRepositoryInterfaces
	 */
	public function __construct(CountryRepositoryInterfaces $countryRepositoryInterfaces)
	{
		$this->countryRepository = $countryRepositoryInterfaces;
		$this->country = $this->country();
	}

	/**
	 * @return mixed
	 */
	public function country(): mixed
	{
		return $this->countryRepository->getCountry()->get();
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
		$view->with('country', $this->country);
	}
}