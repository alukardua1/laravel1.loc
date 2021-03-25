<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository;


use App\Repository\Interfaces\VoteRepositoryInterface;
use Auth;

/**
 * Class VoteRepository
 *
 * @package App\Repositories
 */
class VoteRepository implements VoteRepositoryInterface
{
	/**
	 * @param  int  $id
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
	 * @param  int  $id
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
