<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\MpaaRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MPAARatingController extends Controller
{
	private MpaaRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\MpaaRepositoryInterfaces  $mpaaRepositoryInterfaces
	 */
	public function __construct(MpaaRepositoryInterfaces $mpaaRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $mpaaRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $mpaaUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $mpaaUrl): View|Factory|Application
	{
		$showMpaa = $this->repository->getMpaa($mpaaUrl)->first();
		$this->isNotNull($showMpaa);
		$title = $showMpaa->description;
		$description = null;
		$allAnime = $showMpaa->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showMpaa', 'allAnime', 'title', 'description'));
	}
}
