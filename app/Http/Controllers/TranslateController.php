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
	 * @param  string  $translateUrl
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $translateUrl): Factory|View|Application
	{
		$showTranslate = $this->repository->getTranslate($translateUrl)->first();
		$this->isNotNull($showTranslate);
		$title = $showTranslate->title;
		$description = $showTranslate->description;
		$allAnime = $showTranslate->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showTranslate', 'allAnime', 'title', 'description'));
	}
}
