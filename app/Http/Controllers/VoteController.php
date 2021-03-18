<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Repository\Interfaces\VoteRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class VoteController
 *
 * @package App\Http\Controllers
 */
class VoteController extends Controller
{
	protected VoteRepositoryInterface $voteRepository;

	/**
	 * VoteController constructor.
	 *
	 * @param  VoteRepositoryInterface  $voteRepositoryInterface
	 */
	public function __construct(VoteRepositoryInterface $voteRepositoryInterface)
	{
		parent::__construct();
		$this->voteRepository = $voteRepositoryInterface;
	}

	/**
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function plus(int $id)
	{
		$this->voteRepository->plusVotes($id);

		return url()->previous();
	}

	/**
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function minus(int $id)
	{
		$this->voteRepository->minusVotes($id);

		return url()->previous();
	}
}
