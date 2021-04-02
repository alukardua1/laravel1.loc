<?php

namespace App\Http\Controllers;

use App\Models\YearAired;
use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class YearAiredController
 *
 * @package App\Http\Controllers
 */
class YearAiredController extends Controller
{
	protected YearAiredRepositoryInterfaces $yearAired;

	/**
	 * YearAiredController constructor.
	 *
	 * @param  YearAiredRepositoryInterfaces  $yearAiredRepositoryInterfaces
	 */
	public function __construct(YearAiredRepositoryInterfaces $yearAiredRepositoryInterfaces)
	{
		parent::__construct();
		$this->yearAired = $yearAiredRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $yearUrl
	 *
	 * @return View|Factory|Application
	 */
    public function index(string $yearUrl): View|Factory|Application
    {
	    $showYear = $this->yearAired->getAnime($yearUrl);
	    $this->isNotNull($showYear);
	    $title = $showYear->name;
	    $description = null;
	    $allAnime = $showYear->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showYear', 'allAnime', 'title', 'description'));
    }
}
