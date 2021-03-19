<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Http\Request;

class AnimeAdminController extends Controller
{
	protected AnimeRepositoryInterfaces $animeRepository;

	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->animeRepository = $animeRepositoryInterfaces;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $showAnime = $this->animeRepository->getAllAnime(true)->paginate(50);

        return view($this->backend . 'anime.show_all', compact('showAnime'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $currentAnime = $this->animeRepository->getAnime($id)->first();

        return view($this->backend . 'anime.edit', compact('currentAnime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
	   // \Artisan::call('cache:clear');
       $requestAnime = $this->animeRepository->setAnime($request, $id);

	    if ($requestAnime) {
		    return redirect()->route('editAnimeAdmin', $id);
	    }

	    return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }

	public function search(Request $request)
	{
		if ($request->ajax()) {
			$output = "";
			$animeSearch = $this->animeRepository->getSearchAnime($request);
			if ($animeSearch) {
				$output .= "<ul class=\"list-group\">";
				foreach ($animeSearch as $key => $value) {
					$output .= "<li class=\"list-group-item\"><a href=\"/anime/{$value->id}/edit\">
					<span class=\"searchheading\">{$value->name}</span>
					</a></li>";
				}
				$output .= "</ul>";
				return Response($output);
			}
		}
	}
}
