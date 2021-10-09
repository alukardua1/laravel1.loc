<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Repository\Interfaces\NewsRepositoryInterfaces;
use Illuminate\Http\Request;

class NewsController extends Controller
{
	private NewsRepositoryInterfaces $newsRepository;

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
	public function index()
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
	public function show(int $id)
	{
		$news = $this->newsRepository->getNews($id)->get();

		return view($this->frontend . 'news.full_news', compact('news'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\News  $news
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(News $news)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\News          $news
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, News $news)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\News  $news
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(News $news)
	{
		//
	}
}
