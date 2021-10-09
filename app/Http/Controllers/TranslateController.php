<?php

namespace App\Http\Controllers;

use App\Models\Translate;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
	 * @param  string  $translateUrl
	 *
	 * @return View|Factory|Application
	 */
	public function index(string $translateUrl): View|Factory|Application
	{
		$showTranslate = $this->translate->getTranslate($translateUrl)->first();
		$this->isNotNull($showTranslate);
		$title = $showTranslate->name;
		$description = $showTranslate->description;
		$allAnime = $showTranslate->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showTranslate', 'allAnime', 'title', 'description'));
	}
}
