<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 *
 */
class UserAdminController extends Controller
{
	/**
	 * @var \App\Repository\Interfaces\UserRepositoryInterfaces
	 */
	protected UserRepositoryInterfaces $userRepository;

	/**
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepository
	 */
	public function __construct(UserRepositoryInterfaces $userRepository)
	{
		parent::__construct();
		$this->userRepository = $userRepository;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$allUser = $this->userRepository->getUser();
		dd(__METHOD__, $allUser);
		return view($this->backend . 'user.index', compact($allUser));
	}

	/**
	 * @param  string  $login
	 */
	public function show(string $login)
	{
		$user = $this->userRepository->getUser($login);
		dd(__METHOD__, $user);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\CategoryRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(string $url)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\CategoryRequest  $request
	 * @param  string                              $login
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, string $login)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $login
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(string $login)
	{
		//
	}
}
