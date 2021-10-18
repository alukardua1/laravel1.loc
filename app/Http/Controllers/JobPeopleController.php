<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\JobPeopleRepositoryInterfaces;

class JobPeopleController extends Controller
{
	private JobPeopleRepositoryInterfaces $jobPeopleRepository;

	public function __construct(JobPeopleRepositoryInterfaces $jobPeopleRepositoryInterfaces)
	{
		parent::__construct();
		$this->jobPeopleRepository = $jobPeopleRepositoryInterfaces;
	}

	public function index()
	{
	}
}
