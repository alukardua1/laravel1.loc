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
	protected $country;
	/**
	 * CountryController constructor.
	 */
	public function __construct(CountryRepositoryInterfaces $countryRepositoryInterfaces)
	{
		parent::__construct();
		$this->country = $countryRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $country
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function index($country)
	{
		$showCountry = $this->country->getAnime($country);
		$this->isNotNull($showCountry);
		$title = $showCountry->name;
		$description = $showCountry->description;
		$allAnime = $showCountry->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showCountry', 'allAnime', 'title', 'description'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Country  $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Country $country)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Country  $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Country $country)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Country       $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Country $country)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Country  $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Country $country)
	{
		//
	}
}
