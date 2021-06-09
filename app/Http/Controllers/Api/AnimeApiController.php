<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\AnimeRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Http\JsonResponse;
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
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->apiAnimeRepository = $animeRepositoryInterfaces;
	}

	/**
	 * Вывод всех аниме
	 *
	 * @return JsonResponse
	 */
	public function index(): JsonResponse
	{
		$anime = $this->apiAnimeRepository->getAllAnime()->paginate($this->paginate);
		$anime = $this->animeAllMutations($anime);

		return response()->json($anime);
	}

	/**
	 * Вывод аниме по $id
	 *
	 * @param  string  $id
	 *
	 * @return JsonResponse
	 */
	public function show(string $id): JsonResponse
	{
		$slug = explode('-', $id);
		$thisAnime = $this->apiAnimeRepository->getAnime($slug[0])->first();
		if (empty($thisAnime)) {
			return response()->json($this->error404());
		}
		$thisAnime = $this->animeOneMutations($thisAnime);

		return response()->json($thisAnime);
	}
}
