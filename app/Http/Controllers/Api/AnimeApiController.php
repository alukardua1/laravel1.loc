<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Http\JsonResponse;

class AnimeApiController extends Controller
{
	private AnimeRepositoryInterfaces $repository;
	private array                     $headers = ['Content-Type' => 'application/json; charset=UTF-8'];

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $animeRepositoryInterfaces;
	}

	/**
	 * Вывод всех аниме
	 *
	 * @return JsonResponse
	 */
	public function index(): JsonResponse
	{
		$anime = $this->repository->getAnime()->paginate($this->paginate);
		$anime = $this->animeAllMutations($anime);

		return response()->json($anime);
	}

	/**
	 * Вывод аниме по $id
	 *
	 * @param  int  $id
	 *
	 * @return JsonResponse
	 */
	public function show(int $id): JsonResponse
	{
		$thisAnime = $this->repository->getAnime($id)->first();
		if (empty($thisAnime)) {
			return response()->json($this->error404());
		}
		$thisAnime = $this->animeOneMutations($thisAnime);

		return response()->json($thisAnime, 200, $this->headers);
	}
}
