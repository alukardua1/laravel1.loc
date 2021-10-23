<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CharacterRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CharacterController extends Controller
{
	private CharacterRepositoryInterfaces $repository;

	public function __construct(CharacterRepositoryInterfaces $characterRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $characterRepositoryInterfaces;
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
		$show = $this->repository->getCharacter($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
