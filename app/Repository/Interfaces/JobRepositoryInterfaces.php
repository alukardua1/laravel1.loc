<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface JobRepositoryInterfaces
{
	/**
	 * @param  string  $urlJob
	 *
	 * @return mixed
	 */
	public function getJob(string $urlJob): mixed;

	/**
	 * @param  string                    $urlJob
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return mixed
	 */
	public function setJob(string $urlJob, Request $request): mixed;

	/**
	 * @param  string  $urlJob
	 *
	 * @return mixed
	 */
	public function deleteJob(string $urlJob): mixed;

}