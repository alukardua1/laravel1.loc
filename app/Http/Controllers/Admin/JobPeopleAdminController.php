<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\JobPeopleRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobPeopleAdminController extends Controller
{
	private JobPeopleRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\JobPeopleRepositoryInterfaces  $jobPeopleRepositoryInterfaces
	 */
	public function __construct(JobPeopleRepositoryInterfaces $jobPeopleRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $jobPeopleRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(): View|Factory|Application
	{
		$index = $this->repository->getJobPeople(null, true)->paginate($this->paginate);

		return view($this->backend . 'job_people.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'job_people.add');
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
		$store = $this->repository->setJobPeople($request);

		return $this->ifErrorAddUpdate($store, 'indexJobAdmin', 'Ошибка сохранения');
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
		$edit = $this->repository->getJobPeople($url)->first();

		return view($this->backend . 'job_people.edit', compact('edit'));
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
		$update = $this->repository->setJobPeople($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexJobAdmin', 'Ошибка сохранения');
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
		$delete = $this->repository->deleteJobPeople($url);
		if ($delete) {
			return back();
		}
	}
}
