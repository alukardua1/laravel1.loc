<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserAdminController extends Controller
{
	private UserRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepository
	 */
	public function __construct(UserRepositoryInterfaces $userRepository)
	{
		parent::__construct();
		$this->repository = $userRepository;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$allUser = $this->repository->getUser()->paginate($this->paginate);

		return view($this->backend . 'users.index', compact('allUser'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'users.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\UserRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(UserRequest $request): RedirectResponse
	{
		$requestUser = $this->repository->setUsers($request);

		return $this->ifErrorAddUpdate($requestUser, 'editUserAdmin', 'Ошибка сохранения');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $login
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(string $login): View|Factory|Application
	{
		$user = $this->repository->getUser($login);

		return view($this->backend . 'users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UserRequest  $request
	 * @param  string                          $login
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UserRequest $request, string $login): RedirectResponse
	{
		$requestAnime = $this->repository->setUsers($request, $login);

		return $this->ifErrorAddUpdate($requestAnime, 'editAnimeAdmin', 'Ошибка сохранения', $login);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $login
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(string $login): RedirectResponse
	{
		$delete = $this->repository->destroyUser($login);

		if ($delete) {
			return back();
		}
	}
}
