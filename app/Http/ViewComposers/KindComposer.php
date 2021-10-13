<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\View\View;

class KindComposer
{
	private mixed                    $kind;
	private KindRepositoryInterfaces $kindRepository;

	/**
	 * @param  \App\Repository\Interfaces\KindRepositoryInterfaces  $kindRepositoryInterfaces
	 */
	public function __construct(KindRepositoryInterfaces $kindRepositoryInterfaces)
	{
		$this->kindRepository = $kindRepositoryInterfaces;
		$this->kind = $this->kind();
	}

	/**
	 * @return mixed
	 */
	public function kind(): mixed
	{
		return $this->kindRepository->getKind()->get();
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