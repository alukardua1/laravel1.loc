<?php

namespace App\Http\Controllers;

use App;
use App\Events\AnimeEvent;
use App\Http\Requests\CommentRequest;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Services\FunctionTrait;
use App\Services\ParseShikimori;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimeController extends Controller
{
	use FunctionTrait;
	use ParseShikimori;

	private AnimeRepositoryInterfaces $repository;

	private array $showPlayerGroup;
	private array $attributeArr = [
		'aired'    => 'aired_on',
		'released' => 'released_on',
	];

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $animeRepositoryInterfaces;
		$this->showPlayerGroup = config('secondConfig.showPlayerGroup');
	}

	/**
	 * Все записи
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): Factory|View|Application
	{
		$views['content'] = $this->repository->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('views'));
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function indexOngoing(): View|Factory|Application
	{
		$views['content'] = $this->repository->getCustomAnime('ongoing', 1)->paginate($this->paginate);
		$views['title'] = 'Аниме которые сейчас выходят в Японии';

		return view($this->frontend . 'anime.short', compact('views'));
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function indexAnons()
	{
		$views['content'] = $this->repository->getCustomAnime('anons', 1)->paginate($this->paginate);
		$views['title'] = 'Анонс';

		return view($this->frontend . 'anime.short', compact('views'));
	}

	/**
	 * Показ записи
	 *
	 * @param  int          $id
	 * @param  string|null  $url
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
	 */
	public function show(int $id, string $url = null): View|Factory|RedirectResponse|Application
	{
		$show = $this->repository->getAnime($id)->first();
		$this->isNotNull($show);
		$plus = $show->vote['plus'];
		$minus = -$show->vote['minus'];
		$show->broadcastTitle = $this->broadcast($show->broadcast);
		$show->seasonAired = $show->aired_on ? $this->seasonAired($show->aired_on) : null;
		$this->setAttributes($this->attributeArr, $show);
		$comments = $this->showComments($show->getComments()->withTrashed()->get());
		$show->comments_count = $show->getComments()->count();
		$this->updatePost($show, $this->repository); // @todo сделать очереди задач
		$related = $this->addRelated($show);
		$this->showPlayer($show, $this->showPlayerGroup);
		$regionBlockString = $this->showPlayer($show, $this->showPlayerGroup);
		event(new AnimeEvent($show));

		if ($url !== $show->url) {
			return redirect('/anime/' . $show->id . '-' . $show->url, 301);
		}

		return view($this->frontend . 'anime.full', compact('show', 'plus', 'minus', 'comments', 'related', 'regionBlockString'));
	}

	/**
	 * Поиск
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
	 */
	public function search(Request $request): Response|ResponseFactory
	{
		if ($request->ajax()) {
			$output = "";
			$animeSearch = $this->repository->getSearchAnime($request)->get();
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
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
	 */
	public function doSearch(Request $request): Factory|View|Application
	{
		$views['content'] = $this->repository->getSearchAnime($request, null)->paginate($this->paginate);
		$views['title'] = 'Все аниме где упоминается "' . $request->all()['search'] . '"';

		return view($this->frontend . 'anime.short', compact('views'));
	}

	/**
	 * Вывод RSS
	 *
	 * @return mixed
	 */
	public function animeRss(): mixed
	{
		$feed = App::make("feed");
		$feed->setCache(config('secondConfig.cache_time'), 'laravelFeedKey');
		if (!$feed->isCached()) {
			$posts = $this->repository->getAnime()->limit(config('secondConfig.limitRss'))->get();

			$feed = $this->getRss($feed, $posts);
		}

		return $feed->render('rss');
	}

	/**
	 * Добавление комментария
	 *
	 * @param  int             $id
	 * @param  CommentRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function setComments(CommentRequest $request, int $id): RedirectResponse
	{
		$requestAnime = $this->repository->setComment($request, $id);

		if ($requestAnime) {
			return redirect()->back();
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * Удаление комментария
	 *
	 * @param  int   $commentId
	 * @param  bool  $fullDel
	 *
	 * @throws \Exception
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteComments(int $commentId, bool $fullDel = false): RedirectResponse
	{
		$del = $this->repository->delComments($commentId, $fullDel);

		if ($del) {
			return redirect()->back();
		}

		return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
	}

}
