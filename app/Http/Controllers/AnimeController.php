<?php

namespace App\Http\Controllers;

use App\Events\AnimeEvent;
use App\Models\Anime;
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
		event(new AnimeEvent($showAnime));

		if ($url !== $showAnime->url) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}

		return view($this->frontend . 'anime.full', compact('showAnime', 'plus', 'minus'));
	}

	public function search(Request $request)
	{
		if ($request->ajax()) {
			$output = "";
			$animeSearch = Anime::where('name', 'LIKE', "%{$request->search}%")
				->orWhere('english', 'LIKE', "%{$request->search}%")
				->orWhere('japanese', 'LIKE', "%{$request->search}%")
				->orWhere('synonyms', 'LIKE', "%{$request->search}%")
				->orWhere('license_name_ru', 'LIKE', "%{$request->search}%")
				->orWhere('description', 'LIKE', "%{$request->search}%")
				->limit(5)
				->get();
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

		// multiple feeds are supported
		// if you are using caching you should set different cache keys for your feeds

		// cache the feed for 60 minutes (second parameter is optional)
		$feed->setCache(config('secondConfig.cache_time'), 'laravelFeedKey');

		// check if there is cached feed and build new only if is not
		if (!$feed->isCached()) {
			// creating rss feed with our most recent 20 posts
			$posts = $this->anime->getAllAnime()->limit(config('secondConfig.limitRss'))->get();

			// set your feed's title, description, link, pubdate and language
			$feed->title = 'Your title';
			$feed->description = 'Your description';
			$feed->logo = 'http://yoursite.tld/logo.jpg';
			$feed->link = url('feed');
			$feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
			$feed->pubdate = $posts[0]->created_at;
			$feed->lang = 'en';
			$feed->setShortening(true); // true or false
			$feed->setTextLimit(100);   // maximum length of description text
			$feed->setCustomView($this->frontend . 'feed.rss_yandex');

			foreach ($posts as $post) {
				// set item's title, author, url, pubdate, description, content, enclosure (optional)*
				//$feed->add([$post->name, $post->getUser->login, \URL::to("/anime/{$post->id}-{$post->slug}"), $post->update_at, $post->description, $post->description_html]);
				$feed->addItem(
					[
						'title'       => $post->name,
						'author'      => $post->getUser->login,
						'link'        => \URL::to("/anime/{$post->id}-{$post->url}"),
						'pubdate'     => date("r", strtotime($post->updated_at)),
						'description' => $post->description,
						'content'     => $post->description_html,
						'category'    => $post->getCategory,
						'poster'      => asset('storage/' . $post->original_img),
					]
				);
			}
		}

		// first param is the feed format
		// optional: second param is cache duration (value of 0 turns off caching)
		// optional: you can set custom cache key with 3rd param as string
		return $feed->render('rss');

		// to return your feed as a string set second param to -1
		// $xml = $feed->render('atom', -1);
	}

}
