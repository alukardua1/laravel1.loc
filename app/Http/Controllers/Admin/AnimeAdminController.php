<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimeRequest;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Services\ParseShikimori;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AnimeAdminController
 *
 * @package App\Http\Controllers\Admin
 */
class AnimeAdminController extends Controller
{
	use ParseShikimori;
	protected AnimeRepositoryInterfaces $animeRepository;

	/**
	 * AnimeAdminController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->animeRepository = $animeRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index(): View|Factory|Response|Application
	{
		$showAnime = $this->animeRepository->getAllAnime(true)->paginate(50);

		return view($this->backend . 'anime.show_all', compact('showAnime'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create()
	{
		return view($this->backend. 'anime.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\AnimeRequest  $animeRequest
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function store(AnimeRequest $animeRequest)
	{
		$requestAnime = $this->animeRepository->setAnime($animeRequest);

		if ($requestAnime) {
			return redirect()->route('showAllAnimeAdmin');
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
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
		$currentAnime = $this->animeRepository->getAnime($id)->first();

		//dd(__METHOD__, $this->getShikimori('//shikimori.one/animes/34566'));

		return view($this->backend . 'anime.edit', compact('currentAnime'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\AnimeRequest  $animeRequest
	 * @param  int                              $id
	 *
	 * @return RedirectResponse|Response
	 */
	public function update(AnimeRequest $animeRequest, int $id): Response|RedirectResponse
	{
		// \Artisan::call('cache:clear');
		$requestAnime = $this->animeRepository->setAnime($animeRequest, $id);

		if ($requestAnime) {
			return redirect()->route('editAnimeAdmin', $id);
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function destroy(int $id)
	{
		$delete = $this->animeRepository->destroyAnime($id);

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
		if ($request->ajax()) {
			$output = "";
			$animeSearch = $this->animeRepository->getSearchAnime($request);
			if ($animeSearch) {
				$output .= "<ul class=\"list-group\">";
				foreach ($animeSearch as $key => $value) {
					$output .= "<li class=\"list-group-item\"><a href=\"/anime/{$value->id}/edit\">
					<span class=\"searchheading\">{$value->name}</span>
					</a></li>";
				}
				$output .= "</ul>";
				return Response($output);
			}
		}
	}
}
