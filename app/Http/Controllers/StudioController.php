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
	protected StudioRepositoryInterfaces $studio;

	/**
	 * StudioController constructor.
	 *
	 * @param  \App\Repository\Interfaces\StudioRepositoryInterfaces  $studioRepositoryInterfaces
	 */
	public function __construct(StudioRepositoryInterfaces $studioRepositoryInterfaces)
	{
		parent::__construct();
		$this->studio = $studioRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $studios
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function index($studios)
	{
		$showStudio = $this->studio->getAnime($studios);
		$this->isNotNull($showStudio);
		$title = $showStudio->name;
		$description = $showStudio->description;
		$allAnime = $showStudio->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showStudio', 'allAnime', 'title', 'description'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Studio  $studio
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Studio $studio)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Studio  $studio
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Studio $studio)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Studio        $studio
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Studio $studio)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Studio  $studio
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Studio $studio)
	{
		//
	}
}
