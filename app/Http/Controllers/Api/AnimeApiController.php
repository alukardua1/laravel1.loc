<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\AnimeRepository;
use Illuminate\Http\Request;

class AnimeApiController extends Controller
{
	protected $apiAnime;

	public function __construct(AnimeRepository $animeRepository)
	{
		$this->apiAnime = $animeRepository;
		$this->paginate = env('APP_PAGINATE', 10);
	}

	public function index()
    {
    	$anime = $this->apiAnime->getAllAnime()->paginate($this->paginate);

	    return response()->json($anime);
    }

    public function show($id)
    {
    	$thisAnime = $this->apiAnime->getAnime($id)->first();

    	$thisAnime = $this->animeMutations($thisAnime);

    	return response()->json($thisAnime);
    }
}
