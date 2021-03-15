<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\View\View;

class KindComposer
{
	public    $kind;
	protected $kindRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\KindRepositoryInterfaces  $kindRepositoryInterfaces
	 */
	public function __construct(KindRepositoryInterfaces $kindRepositoryInterfaces)
	{
		$this->kindRepository = $kindRepositoryInterfaces;
		$this->kind = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->kindRepository->getKind();
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
		$view->with('kind', $this->kind);
	}
}