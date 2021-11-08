<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface JobPeopleRepositoryInterfaces
{
	/**
	 * @param  string  $url
	 * @param  bool    $isAdmin
	 *
	 * @return mixed
	 */
	public function getJobPeople(string $url, bool $isAdmin = false): mixed;

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setJobPeople(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteJobPeople(string $url, bool $fullDel = false): mixed;

}