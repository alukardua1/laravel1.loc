<?php

namespace App\Http\Controllers;

use App\Models\Translate;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
	protected $translate;

	public function __construct(TranslateRepositoryInterfaces $translateRepositoryInterfaces)
	{
		parent::__construct();
		$this->translate = $translateRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $translate
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function index($translate)
    {
	    $showTranslate = $this->translate->getAnime($translate);
	    $this->isNotNull($showTranslate);
	    $title = $showTranslate->name;
	    $description = $showTranslate->description;
	    $allAnime = $showTranslate->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showTranslate', 'allAnime', 'title', 'description'));
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
	 * @param  \App\Models\Translate  $translate
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function show(Translate $translate)
    {
	    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Translate  $translate
     * @return \Illuminate\Http\Response
     */
    public function edit(Translate $translate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Translate  $translate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translate $translate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Translate  $translate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Translate $translate)
    {
        //
    }
}
