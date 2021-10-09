<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Repository\Interfaces\StudioRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class StudioController
 *
 * @package App\Http\Controllers
 */
class StudioController extends Controller
{
	protected StudioRepositoryInterfaces $studioRepository;

	/**
	 * StudioController constructor.
	 *
	 * @param  StudioRepositoryInterfaces  $studioRepositoryInterfaces
	 */
	public function __construct(StudioRepositoryInterfaces $studioRepositoryInterfaces)
	{
		parent::__construct();
		$this->studioRepository = $studioRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $studiosUrl
	 *
	 * @return View|Factory|Application
	 */
	public function index(string $studiosUrl): View|Factory|Application
	{
		$showStudio = $this->studioRepository->getStudio($studiosUrl)->first();
		$this->isNotNull($showStudio);
		$title = $showStudio->name;
		$description = $showStudio->description;
		$allAnime = $showStudio->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showStudio', 'allAnime', 'title', 'description'));
	}
}
