<?php


namespace App\Repository;


use App\Models\CopyrightHolder;
use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;

class CopyrightHolderRepository implements CopyrightHolderRepositoryInterfaces
{

	public function getAnime(string $copyrightHolder)
	{
		return CopyrightHolder::where('copyright_holder', $copyrightHolder);
	}

	public function getCopyrightHolder()
	{
		return CopyrightHolder::get();
	}
}