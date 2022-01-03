<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\View\View;

class KindComposer extends ComposersAbstract
{
	private KindRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\KindRepositoryInterfaces  $kindRepositoryInterfaces
	 */
	public function __construct(KindRepositoryInterfaces $kindRepositoryInterfaces)
	{
		$this->repository = $kindRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	protected function view(): mixed
	{
		return $this->repository->getKind()->get();
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
		$view->with('kind', $this->view());
	}
}