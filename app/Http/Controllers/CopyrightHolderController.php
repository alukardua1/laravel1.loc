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
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $url): View|Factory|Application
	{
		$show = $this->repository->getCopyrightHolder($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
