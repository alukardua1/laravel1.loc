<?php

namespace App\Http\Controllers;

use App\Models\Kind;
use App\Repository\Interfaces\KindRepositoryInterfaces;
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
	 * @return mixed
	 */
    public function index(string $kindUrl)
    {
	    $showKind = $this->kindRepository->getAnime($kindUrl);
	    $this->isNotNull($showKind);
	    $title = $showKind->full_name;
	    $description = $showKind->description;
	    $allAnime = $showKind->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showKind', 'allAnime', 'title', 'description'));
    }
}
