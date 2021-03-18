<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Repository\Interfaces\StudioRepositoryInterfaces;
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
	 * @param string $studiosUrl
	 *
	 * @return mixed
	 */
	public function index(string $studiosUrl)
	{
		$showStudio = $this->studioRepository->getAnime($studiosUrl);
		$this->isNotNull($showStudio);
		$title = $showStudio->name;
		$description = $showStudio->description;
		$allAnime = $showStudio->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showStudio', 'allAnime', 'title', 'description'));
	}
}
