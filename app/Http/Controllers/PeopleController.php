<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\PeopleRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PeopleController extends Controller
{
	private PeopleRepositoryInterfaces $peopleRepository;

	public function __construct(PeopleRepositoryInterfaces $peopleRepositoryInterfaces)
	{
		parent::__construct();
		$this->peopleRepository = $peopleRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$people = $this->peopleRepository->getPeople()->pagonate($this->paginate);

		return view($this->frontend . 'people.index', compact('people'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(string $url): View|Factory|Application
	{
		$people = $this->peopleRepository->getPeople($url)->first();
		$this->isNotNull($people);
		$title = $people->russian;
		$description = null;
		$allAnime = $people->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'people.show', compact('people', 'allAnime', 'title', 'description'));
	}
}