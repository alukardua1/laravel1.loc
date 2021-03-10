<?php

namespace App\Http\Controllers;

use App\Events\AnimeEvent;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;

/**
 * Class AnimeController
 *
 * @package App\Http\Controllers
 */
class AnimeController extends Controller
{
	/**
	 * @var \App\Repository\Interfaces\AnimeRepositoryInterfaces
	 */
	private $anime;

	/**
	 * AnimeController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->anime = $animeRepositoryInterfaces;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$allAnime = $this->anime->getAllAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('allAnime'));
	}

	public function indexOngoing()
	{
		$allAnime = $this->anime->getCustomAnime('ongoing', 1)->paginate($this->paginate);
		$title = 'Онгоинг';

		return view($this->frontend . 'anime.short', compact('allAnime', 'title'));
	}

	/**
	 * @param  int   $id
	 * @param  null  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function show(int $id, $url = null)
	{
		$showAnime = $this->anime->getAnime($id)->first();
		$this->isNotNull($showAnime);
		$this->blockPlayer($showAnime);
		$plus = $showAnime->vote['plus'];
		$minus = -$showAnime->vote['minus'];
		$showAnime->broadcastTitle = $this->broadcast($showAnime->broadcast);
		$showAnime->seasonAired = $this->seasonAired($showAnime->aired_on);
		$showAnime->aired = $showAnime->aired_on;
		if ($showAnime->released_on) {
			$showAnime->released = $showAnime->released_on;
		}
		$comments = $this->showComments($showAnime->getComments()->get());

		event(new AnimeEvent($showAnime));

		if ($url !== $showAnime->url) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}

		return view($this->frontend . 'anime.full', compact('showAnime', 'plus', 'minus', 'comments'));
	}

	public function search(Request $request)
	{
		if ($request->ajax()) {
			$output = "";
			$animeSearch = $this->anime->getSearchAnime($request);
			if ($animeSearch) {
				foreach ($animeSearch as $key => $value) {
					$output .= "<a href=\"/anime/{$value->id}-{$value->url}\">
					<span class=\"searchheading\">{$value->name}</span>
					<span>{$value->description}</span>
					</a>";
				}
				return Response($output);
			}
		}
	}

	public function animeRss()
	{
		$feed = \App::make("feed");
		$feed->setCache(config('secondConfig.cache_time'), 'laravelFeedKey');
		if (!$feed->isCached()) {
			$posts = $this->anime->getAllAnime()->limit(config('secondConfig.limitRss'))->get();

			$feed = $this->getRss($feed, $posts);
		}

		return $feed->render('rss');
	}

	public function setComments($id, CommentRequest $request)
	{
		$requestAnime = $this->anime->setComment($id, $request);
		$showAnime = $this->anime->getAnime($id)->first();

		if ($requestAnime) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

}
