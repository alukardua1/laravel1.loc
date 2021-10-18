<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
	private AnimeRepositoryInterfaces $animeRepository;
	private UserRepositoryInterfaces  $userRepository;

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces   $userRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces, UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		parent::__construct();
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->userRepository = $userRepositoryInterfaces;
	}

	/**
	 * Главная страница админки
	 *
	 * @return Factory|View|Application
	 */
	public function index(): Factory|View|Application
	{
		$animeCount = $this->animeRepository->countAnime();

		return view($this->backend . 'layout.components.home', compact('animeCount'));
	}
}
