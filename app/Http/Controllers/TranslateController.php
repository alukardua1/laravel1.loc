<?php

namespace App\Http\Controllers;

use App\Models\Translate;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class TranslateController
 *
 * @package App\Http\Controllers
 */
class TranslateController extends Controller
{
	protected TranslateRepositoryInterfaces $translate;

	/**
	 * TranslateController constructor.
	 *
	 * @param  TranslateRepositoryInterfaces  $translateRepositoryInterfaces
	 */
	public function __construct(TranslateRepositoryInterfaces $translateRepositoryInterfaces)
	{
		parent::__construct();
		$this->translate = $translateRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param string $translateUrl
	 *
	 * @return mixed
	 */
    public function index(string $translateUrl)
    {
	    $showTranslate = $this->translate->getAnime($translateUrl);
	    $this->isNotNull($showTranslate);
	    $title = $showTranslate->name;
	    $description = $showTranslate->description;
	    $allAnime = $showTranslate->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showTranslate', 'allAnime', 'title', 'description'));
    }
}
