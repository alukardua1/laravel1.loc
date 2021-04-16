<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\View\View;

class KindComposer
{
	protected mixed                       $kind;
	protected KindRepositoryInterfaces $kindRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  KindRepositoryInterfaces  $kindRepositoryInterfaces
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