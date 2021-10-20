<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\VoteRepositoryInterface;

class VoteController extends Controller
{
	private VoteRepositoryInterface $repository;

	/**
	 * @param  \App\Repository\Interfaces\VoteRepositoryInterface  $voteRepositoryInterface
	 */
	public function __construct(VoteRepositoryInterface $voteRepositoryInterface)
	{
		parent::__construct();
		$this->repository = $voteRepositoryInterface;
	}

	/**
	 * @param  int  $id
	 *
	 * @return string
	 */
	public function plus(int $id): string
	{
		$this->repository->plusVotes($id);

		return url()->previous();
	}

	/**
	 * @param  int  $id
	 *
	 * @return string
	 */
	public function minus(int $id): string
	{
		$this->repository->minusVotes($id);

		return url()->previous();
	}
}
