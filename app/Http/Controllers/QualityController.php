<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\QualityRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class QualityController
 *
 * @package App\Http\Controllers
 */
class QualityController extends Controller
{
	private QualityRepositoryInterfaces $qualityRepository;

	/**
	 * @param  \App\Repository\Interfaces\QualityRepositoryInterfaces  $qualityRepositoryInterfaces
	 */
	public function __construct(QualityRepositoryInterfaces $qualityRepositoryInterfaces)
	{
		parent::__construct();
		$this->qualityRepository = $qualityRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $qualityUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $qualityUrl): View|Factory|Application
	{
		$showQuality = $this->qualityRepository->getQuality($qualityUrl)->first();
		$this->isNotNull($showQuality);
		$title = $showQuality->title;
		$description = $showQuality->description;
		$allAnime = $showQuality->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showQuality', 'allAnime', 'title', 'description'));
	}
}
