<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryAdminController extends Controller
{
	private CategoryRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $categoryRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index(): View|Factory|Response|Application
	{
		$index = $this->repository->getCategory(null, true)->paginate($this->paginate);

		return view($this->backend . 'category.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): Factory|View|Application
	{
		return view($this->backend . 'category.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\CategoryRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CategoryRequest $request): RedirectResponse
	{
		$store = $this->repository->setCategory($request);

		return $this->ifErrorAddUpdate($store, 'indexCategoryAdmin', 'Ошибка сохранения');
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
		$edit = $this->repository->getCategory($url)->first();

		return view($this->backend . 'category.edit', compact('edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\CategoryRequest  $request
	 * @param  string                              $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(CategoryRequest $request, string $url): RedirectResponse
	{
		$update = $this->repository->setCategory($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexCategoryAdmin', 'Ошибка сохранения');
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
		$delete = $this->repository->deleteCategory($url);
		if ($delete) {
			return back();
		}
	}

	/**
	 * @param  Request  $request
	 *
	 * @return Response|Application|ResponseFactory
	 */
	public function search(Request $request): Response|Application|ResponseFactory
	{
		return $this->searchFun($request);
	}
}
