<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
	protected mixed $animeRepository;
	protected mixed $userRepository;

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
