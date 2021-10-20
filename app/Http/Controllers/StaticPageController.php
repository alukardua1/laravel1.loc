<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\StaticPageRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StaticPageController extends Controller
{

	private StaticPageRepositoryInterfaces $repository;

	public function __construct(StaticPageRepositoryInterfaces $staticPageRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $staticPageRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$allStaticPage = $this->repository->getPage()->paginate(20);

		return view($this->frontend . 'static_page.index', compact('allStaticPage'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $page
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(string $page): View|Factory|Application
	{
		$staticPage = $this->repository->getPage($page)->first();

		return view($this->frontend . 'static_page.show', compact('staticPage'));
	}
}
