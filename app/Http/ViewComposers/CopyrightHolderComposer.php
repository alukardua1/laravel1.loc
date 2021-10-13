<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;
use Illuminate\View\View;

/**
 * Class CopyrightHolderComposer
 *
 * @package App\Http\ViewComposers
 */
class CopyrightHolderComposer
{
	private mixed                               $copyrightHolder;
	private CopyrightHolderRepositoryInterfaces $copyrightHolderRepository;

	/**
	 * CopyrightHolderComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces  $copyrightHolderRepositoryInterfaces
	 */
	public function __construct(CopyrightHolderRepositoryInterfaces $copyrightHolderRepositoryInterfaces)
	{
		$this->copyrightHolderRepository = $copyrightHolderRepositoryInterfaces;
		$this->copyrightHolder = $this->copyrightHolder();
	}

	/**
	 * @return mixed
	 */
	public function copyrightHolder(): mixed
	{
		return $this->copyrightHolderRepository->getCopyrightHolder()->get();
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('copyrightHolder', $this->copyrightHolder);
	}
}