<?php

namespace App\Http\Controllers;

use App\Models\MPAARating;
use App\Repository\Interfaces\MpaaRepositoryInterfaces;
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
	 * @param  \App\Repository\Interfaces\MpaaRepositoryInterfaces  $mpaaRepositoryInterfaces
	 */
	public function __construct(MpaaRepositoryInterfaces $mpaaRepositoryInterfaces)
	{
		parent::__construct();
		$this->mpaaRepository = $mpaaRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $mPAARating
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function index($mPAARating)
    {
	    $showMpaa = $this->mpaaRepository->getAnime($mPAARating);
	    $this->isNotNull($showMpaa);
	    $title = $showMpaa->name;
	    $description = $showMpaa->description;
	    $allAnime = $showMpaa->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showMpaa', 'allAnime', 'title', 'description'));
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
     * @param  \App\Models\MPAARating  $mPAARating
     *
     * @return \Illuminate\Http\Response
     */
    public function show(MPAARating $mPAARating)
    {
	    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MPAARating  $mPAARating
     * @return \Illuminate\Http\Response
     */
    public function edit(MPAARating $mPAARating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MPAARating  $mPAARating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MPAARating $mPAARating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MPAARating  $mPAARating
     * @return \Illuminate\Http\Response
     */
    public function destroy(MPAARating $mPAARating)
    {
        //
    }
}
