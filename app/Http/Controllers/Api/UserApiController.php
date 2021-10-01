<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserApiController extends Controller
{
	protected UserRepositoryInterfaces $userRepository;

	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		parent::__construct();
		$this->userRepository = $userRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param        $login
	 * @param  null  $custom
	 *
	 * @return JsonResponse|Response
	 */
	public function show($login, $custom = null): Response|JsonResponse
	{
		$user = $this->userRepository->getUser($login);
		if (empty($user)) {
			return response()->json($this->error404());
		}
		$user = $this->userMutations($user, $custom);

		return response()->json($user);
	}
}
