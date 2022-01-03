<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CharacterRequest;
use App\Repository\Interfaces\CharacterRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CharacterAdminController extends Controller
{
	private CharacterRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\CharacterRepositoryInterfaces  $characterRepositoryInterfaces
	 */
	public function __construct(CharacterRepositoryInterfaces $characterRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $characterRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$index = $this->repository->getCharacter(null, true)->paginate($this->paginate);

		return view($this->backend . 'character.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'character.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\CharacterRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CharacterRequest $request): RedirectResponse
	{
		$store = $this->repository->setCharacter($request);

		return $this->ifErrorAddUpdate($store, 'indexCharacterAdmin', 'Ошибка сохранения');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(string $url): View|Factory|Application
	{
		$edit = $this->repository->getCharacter($url)->first();

		return view($this->backend . 'character.edit', compact('edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\CharacterRequest  $request
	 * @param  string                               $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(CharacterRequest $request, string $url): RedirectResponse
	{
		$update = $this->repository->setCharacter($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexChannelAdmin', 'Ошибка сохранения');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(string $url): RedirectResponse
	{
		$delete = $this->repository->deleteCharacter($url);
		if ($delete) {
			return back();
		}
	}
}
