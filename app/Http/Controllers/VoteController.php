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
	 * @param  int  $id
	 *
	 * @return string
	 */
	public function plus(int $id): string
	{
		$this->voteRepository->plusVotes($id);

		return url()->previous();
	}

	/**
	 * @param  int  $id
	 *
	 * @return string
	 */
	public function minus(int $id): string
	{
		$this->voteRepository->minusVotes($id);

		return url()->previous();
	}
}
