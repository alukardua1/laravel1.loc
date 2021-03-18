<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;

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
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param        $login
	 * @param  null  $custom
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
	 */
	public function show($login, $custom = null)
	{
		$user = $this->userRepository->getUser($login);
		if (empty($user)) {
			return response()->json($this->error404());
		}
		$user = $this->userMutations($user, $custom);

		return response()->json($user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int                       $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
