<?php

namespace App\Http\Controllers;

use App\Models\CopyrightHolder;
use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CopyrightHolderController extends Controller
{
	protected CopyrightHolderRepositoryInterfaces $copyrightHolderRepository;

	public function __construct(CopyrightHolderRepositoryInterfaces $copyrightHolderRepositoryInterfaces)
	{
		parent::__construct();
		$this->copyrightHolderRepository = $copyrightHolderRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $copyrightHolder
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index($copyrightHolder): View|Factory|Application
	{
		$copyright = $this->copyrightHolderRepository->getAnime($copyrightHolder);
		$this->isNotNull($copyright);
		$title = $copyright->copyright_holder;
		$allAnime = $copyright->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('copyright', 'allAnime', 'title'));
	}
}
