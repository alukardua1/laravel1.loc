<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\MpaaRepositoryInterfaces;
use Illuminate\View\View;

class MpaaRatingComposer
{
	protected mixed                    $mpaa;
	protected MpaaRepositoryInterfaces $mpaaRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  MpaaRepositoryInterfaces  $mpaaRepositoryInterfaces
	 */
	public function __construct(MpaaRepositoryInterfaces $mpaaRepositoryInterfaces)
	{
		$this->mpaaRepository = $mpaaRepositoryInterfaces;
		$this->mpaa = $this->mpaa();
	}

	/**
	 * @return mixed
	 */
	public function mpaa(): mixed
	{
		return $this->mpaaRepository->getMpaa()->get();
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