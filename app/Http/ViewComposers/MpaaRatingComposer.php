<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\KindRepositoryInterfaces;
use App\Repository\Interfaces\MpaaRepositoryInterfaces;
use Illuminate\View\View;

class MpaaRatingComposer
{
	public    $mpaa;
	protected $mpaaRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\MpaaRepositoryInterfaces  $mpaaRepositoryInterfaces
	 */
	public function __construct(MpaaRepositoryInterfaces $mpaaRepositoryInterfaces)
	{
		$this->mpaaRepository = $mpaaRepositoryInterfaces;
		$this->mpaa = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->mpaaRepository->getMpaa();
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
		$view->with('mpaa', $this->mpaa);
	}
}