<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	private $firstAnime;

	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->firstAnime = $animeRepositoryInterfaces;
	}

	public function index()
	{
		$ongoing = $this->firstAnime->getFirstPageAnime(5)->get();

		dd(__METHOD__, $ongoing);
	}
}
