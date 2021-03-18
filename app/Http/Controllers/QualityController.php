<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use App\Repository\Interfaces\QualityRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class QualityController
 *
 * @package App\Http\Controllers
 */
class QualityController extends Controller
{
	protected QualityRepositoryInterfaces $qualityRepository;

	/**
	 * QualityController constructor.
	 *
	 * @param  QualityRepositoryInterfaces  $qualityRepositoryInterfaces
	 */
	public function __construct(QualityRepositoryInterfaces $qualityRepositoryInterfaces)
	{
		parent::__construct();
		$this->qualityRepository = $qualityRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param string $qualityUrl
	 *
	 * @return mixed
	 */
	public function index(string $qualityUrl)
	{
		$showQuality = $this->qualityRepository->getAnime($qualityUrl);
		$this->isNotNull($showQuality);
		$title = $showQuality->name;
		$description = $showQuality->description;
		$allAnime = $showQuality->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showQuality', 'allAnime', 'title', 'description'));
	}
}
