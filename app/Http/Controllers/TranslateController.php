<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TranslateController extends Controller
{
	private TranslateRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\TranslateRepositoryInterfaces  $translateRepositoryInterfaces
	 */
	public function __construct(TranslateRepositoryInterfaces $translateRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $translateRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $url): Factory|View|Application
	{
		$show = $this->repository->getTranslate($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
