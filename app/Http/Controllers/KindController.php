<?php

namespace App\Http\Controllers;

use App\Models\Kind;
use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class KindController
 *
 * @package App\Http\Controllers
 */
class KindController extends Controller
{
	protected KindRepositoryInterfaces $kindRepository;

	/**
	 * KindController constructor.
	 *
	 * @param  KindRepositoryInterfaces  $kindRepositoryInterfaces
	 */
	public function __construct(KindRepositoryInterfaces $kindRepositoryInterfaces)
	{
		$this->kindRepository = $kindRepositoryInterfaces;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param string $kindUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
    public function index(string $kindUrl): View|Factory|Application
    {
	    $showKind = $this->kindRepository->getAnime($kindUrl);
	    $this->isNotNull($showKind);
	    $title = $showKind->full_name;
	    $description = $showKind->description;
	    $allAnime = $showKind->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showKind', 'allAnime', 'title', 'description'));
    }
}
