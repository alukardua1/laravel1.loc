<?php


namespace App\Repository;


use App\Models\CopyrightHolder;
use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class CopyrightHolderRepository
 *
 * @package App\Repository
 */
class CopyrightHolderRepository implements CopyrightHolderRepositoryInterfaces
{

	/**
	 * @param  string  $copyrightHolder
	 *
	 * @return mixed
	 */
	public function getAnime(string $copyrightHolder): mixed
	{
		return CopyrightHolder::where('copyright_holder', $copyrightHolder);
	}

	/**
	 * @return mixed
	 */
	public function getCopyrightHolder(): mixed
	{
		return CopyrightHolder::get();
	}

	/**
	 * @param  string                    $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(string $name, Request $request): mixed
	{
		// TODO: Implement setCopyrightHolder() method.
	}
}