<?php

namespace App\Http\Controllers;

use App\Models\YearAired;
use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\Http\Request;

class YearAiredController extends Controller
{
	protected YearAiredRepositoryInterfaces $yearAired;

	public function __construct(YearAiredRepositoryInterfaces $yearAiredRepositoryInterfaces)
	{
		parent::__construct();
		$this->yearAired = $yearAiredRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $year
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function index($year)
    {
	    $showYear = $this->yearAired->getAnime($year);
	    $this->isNotNull($showYear);
	    $title = $showYear->name;
	    $description = null;
	    $allAnime = $showYear->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showYear', 'allAnime', 'title', 'description'));
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
	 * @param  \App\Models\YearAired  $yearAired
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function show(YearAired $yearAired)
    {
	    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\YearAired  $yearAired
     * @return \Illuminate\Http\Response
     */
    public function edit(YearAired $yearAired)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\YearAired  $yearAired
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, YearAired $yearAired)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\YearAired  $yearAired
     * @return \Illuminate\Http\Response
     */
    public function destroy(YearAired $yearAired)
    {
        //
    }
}
