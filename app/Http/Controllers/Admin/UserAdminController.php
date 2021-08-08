<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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

		return view($this->backend . 'user.index', compact($allUser));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create()
	{
		return view($this->backend . 'user.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\UserRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(UserRequest $request)
	{
		$requestUser = $this->userRepository->setUsers($request);

		return $this->ifErrorAddUpdate($requestUser, 'editUserAdmin', 'Ошибка сохранения');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $login
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(string $login)
	{
		$user = $this->userRepository->getUser($login);

		return view($this->backend . 'user.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UserRequest  $request
	 * @param  string                          $login
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UserRequest $request, string $login)
	{
		$requestAnime = $this->userRepository->setUsers($request, $login);

		return $this->ifErrorAddUpdate($requestAnime, 'editAnimeAdmin', 'Ошибка сохранения', $login);
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
		$delete = $this->userRepository->destroyUser($login);

		if ($delete) {
			return back();
		}
	}
}
