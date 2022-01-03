<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\View\View;

class TranslateComposer extends ComposersAbstract
{
	private TranslateRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\TranslateRepositoryInterfaces  $translateRepositoryInterfaces
	 */
	public function __construct(TranslateRepositoryInterfaces $translateRepositoryInterfaces)
	{
		$this->repository = $translateRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	protected function view(): mixed
	{
		return $this->repository->getTranslate()->get();
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 *
	 * @return \Illuminate\View\View
	 */
	public function compose(View $view)
	{
		return $view->with('translate', $this->view());
	}
}