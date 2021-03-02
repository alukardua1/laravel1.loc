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
	protected $quality;

	/**
	 * QualityController constructor.
	 *
	 * @param  \App\Repository\Interfaces\QualityRepositoryInterfaces  $qualityRepositoryInterfaces
	 */
	public function __construct(QualityRepositoryInterfaces $qualityRepositoryInterfaces)
	{
		parent::__construct();
		$this->quality = $qualityRepositoryInterfaces;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function show($id)
	{
		$showQuality = $this->quality->getAnime($id);
		$this->isNotNull($showQuality);
		$title = $showQuality->name;
		$description = $showQuality->description;
		$allAnime = $showQuality->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showQuality', 'allAnime', 'title', 'description'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Quality  $quality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Quality $quality)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Quality       $quality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Quality $quality)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Quality  $quality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Quality $quality)
	{
		//
	}
}
