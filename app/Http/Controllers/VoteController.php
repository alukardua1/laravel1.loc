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
	protected $voteRepository;

	/**
	 * VoteController constructor.
	 *
	 * @param  \App\Repository\Interfaces\VoteRepositoryInterface  $voteRepositoryInterface
	 */
	public function __construct(VoteRepositoryInterface $voteRepositoryInterface)
	{
		parent::__construct();
		$this->voteRepository = $voteRepositoryInterface;
	}

	public function plus($id)
	{
		$this->voteRepository->plusVotes($id);

		return url()->previous();
	}

	/**
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\RedirectResponse|string
	 */
	public function minus($id)
	{
		$this->voteRepository->minusVotes($id);

		return url()->previous();
	}
}
