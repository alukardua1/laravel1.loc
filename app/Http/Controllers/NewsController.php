<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\NewsRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
	private NewsRepositoryInterfaces $newsRepository;

	/**
	 * @param  \App\Repository\Interfaces\NewsRepositoryInterfaces  $newsRepositoryInterfaces
	 */
	public function __construct(NewsRepositoryInterfaces $newsRepositoryInterfaces)
	{
		$this->newsRepository = $newsRepositoryInterfaces;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): Factory|View|Application
	{
		$news = $this->newsRepository->getNews()->paginate($this->paginate);

		return view($this->frontend . 'news.short_news', compact('news'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(int $id): View|Factory|Application
	{
		$news = $this->newsRepository->getNews($id)->get();

		return view($this->frontend . 'news.full_news', compact('news'));
	}
}
