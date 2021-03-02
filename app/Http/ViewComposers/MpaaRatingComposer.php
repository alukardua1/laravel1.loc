<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\KindRepositoryInterfaces;
use App\Repository\Interfaces\MpaaRepositoryInterface;
use Illuminate\View\View;

class MpaaRatingComposer
{
	public    $menu;
	public    $path;
	protected $mpaa;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\MpaaRepositoryInterface  $mpaaRepositoryInterfaces
	 */
	public function __construct(MpaaRepositoryInterface $mpaaRepositoryInterfaces)
	{
		$this->mpaa = $mpaaRepositoryInterfaces;
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
		return $this->mpaa->getMpaa();
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