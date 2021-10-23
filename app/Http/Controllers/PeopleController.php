<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\PeopleRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PeopleController extends Controller
{
	private PeopleRepositoryInterfaces $repository;

	public function __construct(PeopleRepositoryInterfaces $peopleRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $peopleRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$people = $this->repository->getPeople()->pagonate($this->paginate);

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
		$show = $this->repository->getPeople($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
