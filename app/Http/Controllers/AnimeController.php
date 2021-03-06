<?php

namespace App\Http\Controllers;

use App;
use App\Events\AnimeEvent;
use App\Http\Requests\CommentRequest;
use App\Services\FunctionTrait;
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
	use FunctionTrait;

	private AnimeRepositoryInterfaces $anime;

	private array $showPlayerGroup;
	private array $attributeArr = [
		'aired'    => 'aired_on',
		'released' => 'released_on',
	];

	/**
	 * AnimeController constructor.
	 *
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->anime = $animeRepositoryInterfaces;
		$this->showPlayerGroup = config('secondConfig.showPlayerGroup');
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
		$plus = $showAnime->vote['plus'];
		$minus = -$showAnime->vote['minus'];
		$showAnime->broadcastTitle = $this->broadcast($showAnime->broadcast);
		$showAnime->seasonAired = $this->seasonAired($showAnime->aired_on);
		$this->setAttributes($this->attributeArr, $showAnime);
		$comments = $this->showComments($showAnime->getComments()->withTrashed()->get());
		$showAnime->comments_count = $showAnime->getComments()->count();
		/**
		 * @var $related
		 * @todo Придумать как сделать в relations
		 */
		$related = $showAnime->load('getCategory.getAnime')->inRandomOrder()->limit(6)->get();

		$this->showPlayer($showAnime, $this->showPlayerGroup);
		$regionBlockString = $this->showPlayer($showAnime, $this->showPlayerGroup);

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
	 * @throws \Exception
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
