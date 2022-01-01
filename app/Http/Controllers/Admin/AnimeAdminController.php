<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimeRequest;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimeAdminController extends Controller
{
	private AnimeRepositoryInterfaces $repository;

	/**
	 * @todo К франшизе (если есть фильмы) добавить между какими сериями идет сюжет фильма
	 */

	/**
	 * AnimeAdminController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $animeRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index(): View|Factory|Response|Application
	{
		$index = $this->repository->getAnime(null, true)->paginate(50);

		return view($this->backend . 'anime.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): Factory|View|Application
	{
		return view($this->backend . 'anime.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\AnimeRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function store(AnimeRequest $request): Response|RedirectResponse
	{
		$store = $this->repository->setAnime($request);

		return $this->ifErrorAddUpdate($store, 'indexAnimeAdmin', 'Ошибка сохранения');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return Application|Factory|View|Response
	 */
	public function edit(int $id): Factory|View|Response|Application
	{
		$edit = $this->repository->getAnime($id)->first();

		//dd(__METHOD__, $this->getShikimori('//shikimori.one/animes/34566'));

		return view($this->backend . 'anime.edit', compact('edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\AnimeRequest  $request
	 * @param  int                              $id
	 *
	 * @return RedirectResponse|Response
	 */
	public function update(AnimeRequest $request, int $id): Response|RedirectResponse
	{
		// \Artisan::call('cache:clear');
		$update = $this->repository->setAnime($request, $id);

		return $this->ifErrorAddUpdate($update, 'indexAnimeAdmin', 'Ошибка сохранения', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(int $id): RedirectResponse
	{
		$delete = $this->repository->deleteAnime($id);
		if ($delete) {
			return back();
		}
	}

	/**
	 * @param  Request  $request
	 *
	 * @return Response|Application|ResponseFactory
	 */
	public function search(Request $request): Response|Application|ResponseFactory
	{
		return $this->searchFun($request);
	}
}
