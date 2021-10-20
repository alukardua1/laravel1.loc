<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CopyrightHolderController extends Controller
{
	private CopyrightHolderRepositoryInterfaces $repository;

	public function __construct(CopyrightHolderRepositoryInterfaces $copyrightHolderRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $copyrightHolderRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $copyrightHolder
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $copyrightHolder): View|Factory|Application
	{
		$copyright = $this->repository->getCopyrightHolder($copyrightHolder)->first();
		$this->isNotNull($copyright);
		$title = $copyright->title;
		$allAnime = $copyright->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('copyright', 'allAnime', 'title'));
	}
}
