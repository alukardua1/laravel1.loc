<?php

namespace App\Http\Controllers;

use App;
use App\Events\AnimeEvent;
use App\Http\Requests\CommentRequest;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Http\Response;

/**
 * Class AnimeController
 *
 * @package App\Http\Controllers
 */
class AnimeController extends Controller
{
	private AnimeRepositoryInterfaces $anime;

	/**
	 * AnimeController constructor.
	 *
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->anime = $animeRepositoryInterfaces;
	}

	/**
	 * @return View|Factory|Application
	 */
	public function index(): View|Factory|Application
	{
		$allAnime = $this->anime->getAllAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('allAnime'));
	}

	/**
	 * @return View|Factory|Application
	 */
	public function indexOngoing(): View|Factory|Application
	{
		$allAnime = $this->anime->getCustomAnime('ongoing', 1)->paginate($this->paginate);
		$title = 'Онгоинг';

		return view($this->frontend . 'anime.short', compact('allAnime', 'title'));
	}

	/**
	 * @param  int          $id
	 * @param  string|null  $url
	 *
	 * @return View|Factory|Application
	 */
	public function show(int $id, string $url = null)
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
		$comments = $this->showComments($showAnime->getComments()->withTrashed()->get());
		$showAnime->comments_count = $showAnime->getComments()->count();
		/**
		 * @var $related
		 * @todo Придумать как сделать в relations
		 */
		$related = $showAnime->load('getCategory.getAnime')->inRandomOrder()->limit(6)->get();
		if (Auth::user()) {
		    $groupId = Auth::user()->getGroup->id;
		}else {
			$groupId = 0;
		}
		if (($showAnime->getRegionBlock->isNotEmpty())and(!in_array($groupId, [1,2]))) {
			foreach ($showAnime->getRegionBlock as $item)
			{
				$regionBlock[] = $item->code;
			}
			$regionBlockString = implode(',', $regionBlock);
		}else{
			$regionBlockString = '';
		}

		event(new AnimeEvent($showAnime));

		if ($url !== $showAnime->url) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}

		return view($this->frontend . 'anime.full', compact('showAnime', 'plus', 'minus', 'comments', 'related', 'regionBlockString'));
	}

	/**
	 * @param  Request  $request
	 *
	 * @return Response|ResponseFactory
	 */
	public function search(Request $request): Response|ResponseFactory
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

	/**
	 * @return mixed
	 */
	public function animeRss(): mixed
	{
		$feed = App::make("feed");
		$feed->setCache(config('secondConfig.cache_time'), 'laravelFeedKey');
		if (!$feed->isCached()) {
			$posts = $this->anime->getAllAnime()->limit(config('secondConfig.limitRss'))->get();

			$feed = $this->getRss($feed, $posts);
		}

		return $feed->render('rss');
	}

	/**
	 * @param  int             $id
	 * @param  CommentRequest  $request
	 *
	 * @return RedirectResponse
	 */
	public function setComments(int $id, CommentRequest $request): RedirectResponse
	{
		$requestAnime = $this->anime->setComment($id, $request);

		if ($requestAnime) {
			return redirect()->back();
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * @param  int   $id
	 * @param  int   $commentId
	 * @param  bool  $fullDel
	 *
	 * @return RedirectResponse
	 */
	public function deleteComments(int $id, int $commentId, bool $fullDel = false): RedirectResponse
	{
		$del = $this->anime->delComments($commentId, $fullDel);

		if ($del) {
			return redirect()->back();
		}

		return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
	}

}
