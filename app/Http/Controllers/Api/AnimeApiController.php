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
	/**
	 * @var \App\Repository\Interfaces\AnimeRepositoryInterfaces
	 */
	protected $apiAnime;

	/**
	 * AnimeApiController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->apiAnime = $animeRepositoryInterfaces;
	}

	/**
	 * Вывод всех аниме
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
    {
    	$anime = $this->apiAnime->getAllAnime()->paginate($this->paginate);

	    return response()->json($anime);
    }

	/**
	 * Вывод аниме по $id
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id)
    {
    	$thisAnime = $this->apiAnime->getAnime($id)->first();

    	$thisAnime = $this->animeMutations($thisAnime);

    	return response()->json($thisAnime);
    }
}
