<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\JobPeopleRepositoryInterfaces;

class JobPeopleController extends Controller
{
	private JobPeopleRepositoryInterfaces $repository;

	public function __construct(JobPeopleRepositoryInterfaces $jobPeopleRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $jobPeopleRepositoryInterfaces;
	}

	public function index()
	{
	}
}
