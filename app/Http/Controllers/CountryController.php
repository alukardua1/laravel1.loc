<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class CountryController
 *
 * @package App\Http\Controllers
 */
class CountryController extends Controller
{
	protected CountryRepositoryInterfaces $countryRepository;

	/**
	 * CountryController constructor.
	 *
	 * @param  CountryRepositoryInterfaces  $countryRepositoryInterfaces
	 */
	public function __construct(CountryRepositoryInterfaces $countryRepositoryInterfaces)
	{
		parent::__construct();
		$this->countryRepository = $countryRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param string $countryUrl
	 *
	 * @return mixed
	 */
	public function index(string $countryUrl)
	{
		$showCountry = $this->countryRepository->getAnime($countryUrl);
		$this->isNotNull($showCountry);
		$title = $showCountry->name;
		$description = $showCountry->description;
		$allAnime = $showCountry->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showCountry', 'allAnime', 'title', 'description'));
	}
}
