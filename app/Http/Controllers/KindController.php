<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class KindController
 *
 * @package App\Http\Controllers
 */
class KindController extends Controller
{
	private KindRepositoryInterfaces $kindRepository;

	/**
	 * @param  \App\Repository\Interfaces\KindRepositoryInterfaces  $kindRepositoryInterfaces
	 */
	public function __construct(KindRepositoryInterfaces $kindRepositoryInterfaces)
	{
		$this->kindRepository = $kindRepositoryInterfaces;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $kindUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $kindUrl): View|Factory|Application
	{
		$showKind = $this->kindRepository->getKind($kindUrl)->first();
		$this->isNotNull($showKind);
		$title = $showKind->full_name;
		$description = $showKind->description;
		$allAnime = $showKind->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showKind', 'allAnime', 'title', 'description'));
	}
}
