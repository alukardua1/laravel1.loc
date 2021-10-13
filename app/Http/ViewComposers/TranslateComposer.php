<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\View\View;

class TranslateComposer
{
	private mixed                         $translate;
	private TranslateRepositoryInterfaces $translateRepository;

	/**
	 * @param  \App\Repository\Interfaces\TranslateRepositoryInterfaces  $translateRepositoryInterfaces
	 */
	public function __construct(TranslateRepositoryInterfaces $translateRepositoryInterfaces)
	{
		$this->translateRepository = $translateRepositoryInterfaces;
		$this->translate = $this->translate();
	}

	/**
	 * @return mixed
	 */
	public function translate(): mixed
	{
		return $this->translateRepository->getTranslate()->get();
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
		$view->with('translate', $this->translate);
	}
}