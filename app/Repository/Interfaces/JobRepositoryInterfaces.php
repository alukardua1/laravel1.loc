<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface JobRepositoryInterfaces
{
	public function getJob(string $urlJob);

	public function setJob(string $urlJob, Request $request);

	public function deleteJob(string $urlJob);

}