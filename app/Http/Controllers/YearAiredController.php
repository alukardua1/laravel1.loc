<?php

namespace App\Http\Controllers;

use App\Models\YearAired;
use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
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
	 * @param string $yearUrl
	 *
	 * @return mixed
	 */
    public function index(string $yearUrl)
    {
	    $showYear = $this->yearAired->getAnime($yearUrl);
	    $this->isNotNull($showYear);
	    $title = $showYear->name;
	    $description = null;
	    $allAnime = $showYear->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showYear', 'allAnime', 'title', 'description'));
    }
}
