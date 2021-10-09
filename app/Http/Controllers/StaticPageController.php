<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use App\Repository\Interfaces\StaticPageRepositoryInterfaces;

class StaticPageController extends Controller
{

	protected StaticPageRepositoryInterfaces $staticPageRepository;

	public function __construct(StaticPageRepositoryInterfaces $staticPageRepositoryInterfaces)
	{
		parent::__construct();
		$this->staticPageRepository = $staticPageRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$allStaticPage = $this->staticPageRepository->getPage()->paginate(20);

		return view($this->frontend . 'static_page.index', compact('allStaticPage'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $page
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show($page)
	{
		$staticPage = $this->staticPageRepository->getPage($page)->first();

		return view($this->frontend . 'static_page.show', compact('staticPage'));
	}
}
