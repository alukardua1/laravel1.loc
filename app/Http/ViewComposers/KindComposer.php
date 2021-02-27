<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\View\View;

class KindComposer
{
	public $menu;

	public $path;

	protected $kind;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\KindRepositoryInterfaces  $kindRepositoryInterfaces
	 */
	public function __construct(KindRepositoryInterfaces $kindRepositoryInterfaces)
	{
		$this->kind = $kindRepositoryInterfaces;
		$this->menu = $this->menu();
		$this->path = $this->path();
	}

	/**
	 * @return mixed
	 */
	public function path()
	{
		return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->kind->getKind();
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 *
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('menu', $this->menu);
		$view->with('path', $this->path);
	}
}