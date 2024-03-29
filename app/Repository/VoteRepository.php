<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository;


use App\Repository\Interfaces\VoteRepositoryInterface;
use Auth;

class VoteRepository implements VoteRepositoryInterface
{
	/**
	 * Нравится
	 *
	 * @param  int  $id  ID записи
	 *
	 * @return mixed
	 */
	public function plusVotes(int $id): mixed
	{
		Auth::user()
			->vote()
			->attach($id, ['votes' => 1]);
	}

	/**
	 * Не нравится
	 *
	 * @param  int  $id  ID записи
	 *
	 * @return mixed
	 */
	public function minusVotes(int $id): mixed
	{
		Auth::user()
			->vote()
			->attach($id, ['votes' => -1]);
	}
}
