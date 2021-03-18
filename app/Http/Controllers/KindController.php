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
	protected KindRepositoryInterfaces $kind;

	/**
	 * KindController constructor.
	 *
	 * @param  \App\Repository\Interfaces\KindRepositoryInterfaces  $kindRepositoryInterfaces
	 */
	public function __construct(KindRepositoryInterfaces $kindRepositoryInterfaces)
	{
		$this->kind = $kindRepositoryInterfaces;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $kind
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function index($kind)
    {
	    $showKind = $this->kind->getAnime($kind);
	    $this->isNotNull($showKind);
	    $title = $showKind->full_name;
	    $description = $showKind->description;
	    $allAnime = $showKind->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showKind', 'allAnime', 'title', 'description'));
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
	 * @param  \App\Models\Kind  $kind
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function show(Kind $kind)
    {
    	//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
