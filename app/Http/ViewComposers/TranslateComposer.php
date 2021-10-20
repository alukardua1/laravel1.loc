<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\View\View;

class TranslateComposer
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
	public function view(): mixed
	{
		return $this->repository->getTranslate()->get();
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
		$view->with('translate', $this->view());
	}
}