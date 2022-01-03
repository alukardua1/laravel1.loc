<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TranslateAdminController extends Controller
{
	private TranslateRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\TranslateRepositoryInterfaces  $translateRepositoryInterfaces
	 */
	public function __construct(TranslateRepositoryInterfaces $translateRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $translateRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(): View|Factory|Application
	{
		$index = $this->repository->getTranslate(null, true)->paginate($this->paginate);

		return view($this->backend . 'translate.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'translate.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		$store = $this->repository->setTranslate($request);

		return $this->ifErrorAddUpdate($store, 'indexTranslateAdmin', 'Ошибка сохранения');
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
		$edit = $this->repository->getTranslate($url)->first();

		return view($this->backend . 'translate.edit', compact('edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string                    $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, string $url): RedirectResponse
	{
		$update = $this->repository->setTranslate($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexTranslateAdmin', 'Ошибка сохранения');
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
		$delete = $this->repository->deleteTranslate($url);
		if ($delete) {
			return back();
		}
	}
}
