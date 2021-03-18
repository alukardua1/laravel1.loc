<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\AnimeRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class AnimeApiController
 *
 * @package App\Http\Controllers\Api
 */
class AnimeApiController extends Controller
{
	protected AnimeRepositoryInterfaces $apiAnimeRepository;

	/**
	 * AnimeApiController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->apiAnimeRepository = $animeRepositoryInterfaces;
	}

	/**
	 * Вывод всех аниме
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		$anime = $this->apiAnimeRepository->getAllAnime()->paginate($this->paginate);
		$anime = $this->animeAllMutations($anime);

		return response()->json($anime);
	}

	/**
	 * Вывод аниме по $id
	 *
	 * @param int $id
	 *
	 * @return array|\Illuminate\Http\JsonResponse
	 */
	public function show(int $id)
	{
		$thisAnime = $this->apiAnimeRepository->getAnime($id)->first();
		if (empty($thisAnime)) {
			return response()->json($this->error404());
		}
		$thisAnime = $this->animeOneMutations($thisAnime);

		return response()->json($thisAnime);
	}
}
