<?php

namespace App\Http\Controllers;

use App\Models\MPAARating;
use App\Repository\Interfaces\MpaaRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class MPAARatingController
 *
 * @package App\Http\Controllers
 */
class MPAARatingController extends Controller
{
	protected MpaaRepositoryInterfaces $mpaaRepository;

	/**
	 * MPAARatingController constructor.
	 *
	 * @param  MpaaRepositoryInterfaces  $mpaaRepositoryInterfaces
	 */
	public function __construct(MpaaRepositoryInterfaces $mpaaRepositoryInterfaces)
	{
		parent::__construct();
		$this->mpaaRepository = $mpaaRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $mpaaUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
    public function index(string $mpaaUrl): View|Factory|Application
    {
	    $showMpaa = $this->mpaaRepository->getAnime($mpaaUrl);
	    $this->isNotNull($showMpaa);
	    $title = $showMpaa->name;
	    $description = $showMpaa->description;
	    $allAnime = $showMpaa->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showMpaa', 'allAnime', 'title', 'description'));
    }
}
