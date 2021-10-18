<?php

namespace App\Repository;

use App\Repository\Interfaces\JobPeopleRepositoryInterfaces;
use Illuminate\Http\Request;

class JobPeopleRepository implements JobPeopleRepositoryInterfaces
{

	/**
	 * @param  string  $url
	 *
	 * @return mixed
	 */
	public function getJobPeople(string $url): mixed
	{
		// TODO: Implement getJob() method.
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setJobPeople(Request $request, string $url = null): mixed
	{
		// TODO: Implement setJob() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteJobPeople(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement deleteJob() method.
	}
}